$(document).ready(function () {

$(document).on('click', function () {
    const path = 'http://localhost/Sama_Chambre';
    const formLogin = $('#formLogin')
    formLogin.submit(function (e) {
    });
})

    const bourse = $('#bourse').val();
    var type = '';
    $('#bourse').change(function (){
        $('select option:selected').each(function (){
            if($(this).val() === 'non'){
                type = 'non';
            }
            if($(this).val() === 'pension'){
                type = 'pension';
            }
            if($(this).val() === 'demi-bourse'){
                type = 'demi-bourse';
            }
        });

        if(type === 'demi-bourse' || type === 'pension'){

            $('#type-etudiant').html('');
            $('#chambre').html('');

            $('#type-etudiant').append('<label for="logement" class="col-sm-2 col-form-label">Logement</label>\n' +
                '            <div class="col-sm-10">\n' +
                '                 <select class="form-control" id="logement" name="logement">\n' +
                '                        <option value="null">Choisir</option>' +
                '                        <option value="oui">Oui</option>\n' +
                '                        <option value="non">Non</option>\n' +
                '                </select>\n' +
                '            </div>');
        }

        if(type === 'non'){
            $('#type-etudiant').html('');
            $('#chambre').html('');

            $('#type-etudiant').append('<label for="adresse" class="col-sm-2 col-form-label">Adresse</label>\n' +
                '            <div class="col-sm-10">\n' +
                '                <input type="text" class="form-control p-1" name="adresse" id="adresse" placeholder="adresse">\n' +
                '            </div>')
        }
    });

    $('#type-etudiant').on('change', '#logement', function () {
        $('#chambre').html('');
        if($(this).val() === 'oui'){
            $('#chambre').append('<label for="logement" class="col-sm-2 col-form-label">Chambre Numéro</label>\n' +
                '            <div class="col-sm-10">\n' +
                '                 <select class="form-control" id="chambreType" name="chambre">\n' +
                '                        <option value="null">Choisir</option>' +
                '                </select>\n' +
                '            </div>');
            affichageSelect();
        }
    })
    function affichageSelect() {
        var i =1;
        $.each(tab, (indice, valeur) => {
            $('#chambreType').append('<option value="'+valeur['numeroChambre']+'" id="typ'+i+'"></option>');
            $('#chambreType #typ'+i+'').text(valeur['numeroChambre']);
            i++;

        })

    }
    var formCreateEtudiant = $('#formCreateEtudiant');

    $('#formCreateEtudiant').on('submit', function (e) {
        e.preventDefault();
        var $this = $(this);
        $.ajax({
            url:$this.attr('action'),
            type:'post',
            data:$this.serialize(),
            success: function (data) {
                $('.errors').html('');
                $('.errors').html(data);
            }
        });
    });

    $('.createChambre').submit(function (e){
        e.preventDefault();
        var $this = $(this);
        $.ajax({
            url:$this.attr('action'),
            type:'post',
            data:$this.serialize(),
            success: function (data) {
                $('.errors').html('');
                $('.errors').html(data);
            }
        });
    })

    //Scrollling des questions

    let offset = 0;
    const tbody = $('#tbody');
    $.ajax({
            url:'http://localhost/Sama_Chambre/admin/ListesDesEtudiants',
            type:'post',
            dataType:'JSON',
            success: function (data){
                $('tbody').html('');
                printData(data,tbody);
                offset +=4;
            }
    })

    const scrollZone = $('#scrollZone')
    /*
    scrollZone.scroll(function() {
        //console.log(scrollZone[0].clientHeight)
        const st = scrollZone[0].scrollTop;
        const sh = scrollZone[0].scrollHeight;
        const ch = scrollZone[0].clientHeight;
        console.log(st);
        console.log(sh);
        console.log(ch);
        if(sh-st <= ch){
            $.ajax({
                url:'http://localhost/Sama_Chambre/admin/ListesDesEtudiants',
                type:'post',
                data:{limit:2,offset:offset},
                dataType:'JSON',
                success: function (data){
                    printData(data,tbody);
                    offset +=2;
                }
            });
        }
    });*/
    function printData(data, tbody){
        $.each(data, function (indice, user){
            tbody.append(`
        <tr class="" id="${user.id}">
                <td>${user.matricule}</td>
                <td>${user.prenom}</td>
                <td>${user.nom}</td>
                <td>${user.bourse}</td>
                <td>${user.tel}</td>
                <td>${user.chambre}</td>
                <td>
                    <button class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop" id="${user.id}"><i class="fas fa-pen-square" ></i></button>
                    <button class="btn btn-danger" id="${user.id}"><i class="fas fa-trash"></i></button>
                </td>
            </tr>`)
        })
    }


    //Modification User

    $('#tbody').on('click', 'td .btn-primary', function () {
        let offset = 0;
        var id = $(this).attr('id');
        $.ajax({
            url:'http://localhost/Sama_Chambre/admin/ListesDesEtudiants',
            type:'post',
            data:{limit:4,offset:offset},
            dataType:'JSON',
            success: function (data){
                $('#modal-body').html('');
                showUser(data,id)
                offset += 4;
            }
        });
    })

    //Suppression
    $('#tbody').on('click', 'td .btn-danger', function () {
        var id = $(this).attr('id');
        $.ajax({
            url:'http://localhost/Sama_Chambre/admin/deleteUser',
            type:'post',
            data:{id:id},
            success:confirm('Voulez vous suprimer?')
        });
    });


    function showUser(data,id){
        for(var i=0; i<data.length;i++){
            if(id === data[i]['id']){
                $('#modal-body').append('<div class="form-row">\n' +
                    '  <div class="form-row">\n' +
                    '  <div class="col-md-6 mb-3">\n' +
                    '    <label for="matricule">Matricule</label>\n' +
                    '    <input type="hidden" name="id" value='+data[i]['id']+'>' +
                    '    <input type="text" class="form-control" name="matricule" id="matricule" value='+data[i]['matricule']+' readonly="readonly">\n' +
                    '      <div class="valid-tooltip">\n' +
                    '\n' +
                    '      </div>\n' +
                    '   </div>\n' +
                    '    <div class="col-md-6 mb-3">\n' +
                    '      <label for="bourse">Bourse</label>\n' +
                    '      <input type="text" class="form-control" name="bourse" value='+data[i]['bourse']+' id="bourse" disabled>\n' +
                    '      <div class="valid-tooltip">\n' +
                    '    </div>\n' +
                    '   </div>\n' +
                    ' </div>  ' +
                    '<div class="col-md-6 mb-3">\n' +
                    '      <label for="prenom">Prenom</label>\n' +
                    '      <input type="text" class="form-control" id="prenom" name="prenom" value='+data[i]['prenom']+'>\n' +
                    '      <div class="valid-tooltip">\n' +
                    '        Looks good!\n' +
                    '      </div>\n' +
                    '    </div>\n' +
                    '    <div class="col-md-6 mb-3">\n' +
                    '      <label for="nom">Nom</label>\n' +
                    '      <input type="text" class="form-control" name="nom" id="nom" value='+data[i]['nom']+'>\n' +
                    '      <div class="valid-tooltip">\n' +
                    '        Looks good!\n' +
                    '      </div>\n' +
                    '    </div>\n' +
                    '  </div>' +
                    '<div class="form-row">\n' +
                    '    <div class="col-md-6 mb-3">\n' +
                    '      <label for="email">Email</label>\n' +
                    '      <input type="text" class="form-control" name="email" id="email" value='+data[i]['email']+'>\n' +
                    '      <div class="valid-tooltip">\n' +
                    '        Looks good!\n' +
                    '      </div>\n' +
                    '    </div>\n' +
                    '    <div class="col-md-6 mb-3">\n' +
                    '      <label for="tel">Telephone</label>\n' +
                    '      <input type="text" class="form-control" name="tel" id="tel" value='+data[i]['tel']+'>\n' +
                    '      <div class="valid-tooltip">\n' +
                    '        Looks good!\n' +
                    '      </div>\n' +
                    '    </div>\n' +
                    '  </div>' +
                    '<div class="form-row">\n' +
                    '  <div class="col-md-6 mb-3">\n' +
                    '    <label for="chambre">Chambre</label>\n' +
                    ' <input type="text" class="form-control" name="chambre" id="chambre" value='+data[i]['chambre']+' disabled>\n' +
                    '      <div class="valid-tooltip">\n' +
                    '\n' +
                    '      </div>\n' +
                    '   </div> \n' +
                    '    <div class="col-md-6 mb-3">\n' +
                    '      <label for="date">Date Naissance</label>\n' +
                    '      <input type="date" class="form-control" name="dateNaissance" id="date" value='+data[i]['dateNaissance']+'>\n' +
                    '      <div class="valid-tooltip">\n' +
                    '    </div>\n' +
                    '   </div>\n' +
                    ' </div>')
            }
        }
    }

    $('.needs-validation').on('submit',function (e) {
        e.preventDefault();
        var iduser = $('#tbody td .btn-primary').attr('id');
        var $this = $(this);
        $.ajax({
            url:$this.attr('action'),
            type:'post',
            data:$this.serialize(),
            success: function (data) {
                $('.error').html('');
                $('.error').append(data);
            }
        });
    })


    //Recherche

    function Search(idSearch,  idform){
        $('#'+idSearch+'').keyup(function () {
            var search = $(this).val();
            const tbody = $('#tbody');
            if(search !== ""){
                const url_route = $('#'+idform+'').attr('action');
                $.ajax({
                    url:url_route,
                    type:'post',
                    data:{search:search},
                    dataType:'json',
                    success:function (data) {
                        tbody.html('');
                        printData(data,tbody);
                    }
                });
            }
        });
    }

    Search('search', 'formSearch');

    Search('searchBourse','formSearchBourse');

    Search('searchChambre','formSearchChambre');



    var nmbreUserParPage = 2;
    $(document).ready(function() {

        var urlChambre =  $('#formListeChambre').attr('action');
//        button_prev, button_next, id_text_row, id_text_allcount
//       #but_prev, #but_next, txt_rowid,txt_allcount
        function affichageUser(url_traitement, idtableau, button_prev, button_next, id_text_row, id_text_allcount) {
            getData(url_traitement, idtableau, id_text_row, id_text_allcount);
            $('#' + button_prev + '').click(function () {
                var rowid = Number($('#' + id_text_row + '').val());
                var allcount = Number($('#' + id_text_allcount + '').val());
                rowid -= nmbreUserParPage;
                if (rowid < 0) {
                    rowid = 0;
                }
                $('#' + id_text_row + '').val(rowid);
                getData(url_traitement, idtableau, id_text_row, id_text_allcount);
            });
            $('#' + button_next + '').click(function () {
                var rowid = Number($('#' + id_text_row + '').val());
                var allcount = Number($('#' + id_text_allcount + '').val());
                rowid += nmbreUserParPage;
                if (rowid <= allcount) {
                    $('#' + id_text_row + '').val(rowid);
                    getData(url_traitement, idtableau, id_text_row, id_text_allcount);
                }
            });
        }

        /* Traitement des données */

        function getData(url, idtable, id_text, id_text_allCount) {
            var rowid = $('#' + id_text + '').val();
            var allcount = $('#' + id_text_allCount + '').val();

            $.ajax({
                url: url,
                type: 'post',
                data: {rowid: rowid, rowperpage: nmbreUserParPage},
                dataType: 'json',
                success: function (response) {
                    createTablerow(response, idtable, id_text_allCount);
                }
            });

        }

        /* Fonction Creation de table */
        function createTablerow(data, id_tab, id_text_all) {

            var dataLen = data.length;

            $('' + id_tab + ' tr:not(:first)').remove();

            for (var i = 0; i < dataLen; i++) {
                if (i === 0) {
                    var allcount = data[i]['allcount'];
                    $('#' + id_text_all + '').val(allcount);

                }else {
                    var id = data[i]['id'];
                    var numeroChambre = data[i]['numeroChambre'];
                    var numeroBatiment = data[i]['numeroBatiment'];
                    var type_chambre = data[i]['type_chambre'];

                    $(id_tab).append("<tr id='tr_" + i + "'></tr>");
                    $("#tr_" + i).append("<td>" + numeroChambre + "</td>");
                    $("#tr_" + i).append("<td>" + numeroBatiment + "</td>");
                    $("#tr_" + i).append("<td>" + type_chambre + "</td>");
                    $("#tr_" + i).append("<td><input type='hidden' name='idChambre' value="+id+"></td>");
                    $("#tr_" + i).append("<td class=' row justify-content-around'>" +
                        "<button id='"+ id +"' data-toggle=\"modal\" data-target=\"#staticBackdrop\" class='col-4 btn btn-primary fas fa-pen-square modification'></button>" +
                        "<button id='"+ id +"' class='col-4 btn btn-danger fas fa-trash supprimer'></button>" +
                        "</td>");
                    if(i===dataLen){
                        $('#but_next_joueur').attr('disabled',disabled);
                    }

                }
            }
        }

        affichageUser(urlChambre,'#id_table','but_prev_joueur',
            'but_next_joueur','txt_rowid_joueur', 'txt_allcount_joueur');

        //Modification Chambre

    });

  $('#chambreElement').on('click', 'button', function (e) {
        e.preventDefault();
      var id =  $(this).attr('id');
      var url = $('#modal-body-chambre').attr('action');
      $.ajax({
          url:url,
          type:'post',
          data:{id:id},
          dataType:'json',
          success:function (data){
                showChambre(data,id);
          }
      })
  })

    function showChambre(data,id){

      $.each(data, function (indice,chambre){
            if(id === chambre.id){
                $('#modal-body-chambre').html('');
                $('#modal-body-chambre').append(
                    '  <div class="form-group row">\n' +
                    '<input type="hidden" name="id" value="'+id+'">'+
                    '    <label for="numeroChambre" class="col-sm-2 col-form-label">Numero Chambre</label>\n' +
                    '    <div class="col-sm-10">\n' +
                    '      <input type="text" readonly="readonly" name="numeroChambre" class="form-control" id="numeroChambre" value="'+chambre.numeroChambre+'">\n' +
                    '    </div>\n' +
                    '  </div>' +
                    ' <div class="form-group row">\n' +
                    '    <label for="numeroBatiment" class="col-sm-2 col-form-label">Numero Batiment</label>\n' +
                    '    <div class="col-sm-10">\n' +
                    '      <input type="number" class="form-control" id="numeroBatiment" name="numeroBatiment" value="'+chambre.numeroBatiment+'" required >\n' +
                    '    </div>\n' +
                    '  </div>' +
                    ' <div class="form-group row">\n' +
                    '    <label for="typeChambre" class="col-sm-2 col-form-label">Type chambre</label>\n' +
                    '    <div class="col-sm-10">\n' +
                    '      <input type="text" readonly="readonly" class="form-control" id="typeChambre" name="typeChambre" value="'+chambre.type_chambre+'" >\n' +
                    '    </div>\n' +
                    '  </div>\n'
                   )
            }
      });

      $('#modal-body-chambre').submit(function (e) {
            e.preventDefault();
            var $this = $(this);
          var url = $('#close').attr('name');
          $.ajax({
              url:url,
              type:'post',
              data:$this.serialize(),
              success:function () {
                $('.error').html('');
              }
          });
      })
    }

    $('.LesChambres').on('click','.supprimer',function (e) {
        e.preventDefault();
        var id = $(this).attr('id');
        var url = $('#txt_allcount_joueur').attr('name');
        $.ajax({
            url:'http://localhost/Sama_Chambre/admin/deleteChambre',
            type:'post',
            data:{id:id},
            success:confirm('Vous voulez vous supprimez?'),
        })
    })

})
