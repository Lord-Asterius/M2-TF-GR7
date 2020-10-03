var data;

$(document).ready(function() {+
    
    reload();
 
});


function reload() {

    $.ajax({
        url: "index.php?page=load_absence_details&student_id="+selected_user_id,
        type: 'post',
        data: {
            form: "reload",
        },
        success: function(respuesta_servidor) {

            data = JSON.parse(respuesta_servidor);
           
            $("#table_data").empty();
            var thead = "<thead>"+ 
            "<th>Student</th>"+
            "<th>Module</th>"+
            "<th>Date</th>"+
            "<th>Reason</th>"+
            "<th>Action</th>"+
            "</thead>";

            $("#table_data").append(thead);
            for (var i = 0; i < data.length; i++) {
                var id_abcense = data[i]["id_absence"];
                var id_studient = data[i]["id_etudiant"];
                

                var first_name = data[i]["first_name"];
                var comment = data[i]["comment"];
                var date = data[i]["date"];
                var reason = data[i]["reason"];

                var html = '<tr>' +
                        '<td>' +
                        '<a href="index.php" >' + first_name + '</a>' +
                        '</td>' +
                        '<td>'+comment+'</td>' +
                        '<td>'+date+'</td>' +
                        '<td>'+reason+'</td>' +
                        '<td>' +
                        '<p data-placement="top" data-toggle="tooltip" title="Delete">' +                       
                        '<button class="btn btn-sm btn-danger" onClick="javascript:delete_student(' + id_abcense + ',' + id_studient + ')"  title="Click to delete this element" >' +
                        '<i class="gj-icon delete"></i>' +
                        '</button>'+
                        '<i class="gj-icon plus"></i>' +
                        '<button ' +
                        'class="btn btn-primary btn-xs" ' +
                        'data-title="Edit" ' +
                        'data-toggle="modal" ' +
                        'data-target="#edit" ' +
                        'onClick="javascript:load_modify_window(' + id_abcense + ',' + id_studient + ')"  title="Click for edit this element" >' +
                        '<i class="gj-icon pencil"></i>' +
                        '</button>'+                                                
                        '</p>' +
                        '</td>' +
                        '</tr>';

                $("#table_data").append(html);
            }


        }
    });
}

function addStudent() {
    var nom_etudiant = $("#student-name").val();
    var date = $("#date").val();
    var module = $("#subject").val();
    var motif_absence = $("#reason").val();

    $.ajax({
        url: "index.php?page=add_absence_details",
        type: 'post',
        data: {
            form: "add_student",
            nom_etudiant: nom_etudiant,
            date: date,
            module: module,
            motif_absence: motif_absence,
            student_id:selected_user_id
        },
        success: function(respuesta_servidor) {
            alert(respuesta_servidor);

            $("#student-name").val("");
            $("#date").val("");
            $("#subject").val("");
            $("#reason").val("");

            reload();

        }
    });
}

function delete_student(id_absence, id_student) {

    $.ajax({
        url: "index.php?page=delete_absence_details",
        type: 'post',
        data: {
            form: "delete_student",
            id_absence: id_absence,
            id_student: id_student,            
        },
        success: function(respuesta_servidor) {
            alert(respuesta_servidor);

            reload();
        }
    });
}

function modify() {
    var id_absence = $("#edit #id_absence").val();
    var id_student = $("#edit #id_student").val();    

    var nom_etudiant = $("#edit #student-name").val();
    var date = $("#edit #date").val();
    var module = $("#edit #subject").val();
    var motif_absence = $("#edit #reason").val();

    $.ajax({
        url: "index.php?page=edit_absence_details",
        type: 'post',
        data: {
            form: "modify_student",
            id_absence: id_absence,
            id_student: id_student,

            nom_etudiant: nom_etudiant,
            date: date,
            module: module,
            motif_absence: motif_absence,
        },
        success: function(respuesta_servidor) {
            alert(respuesta_servidor);

            reload();

        }
    });
}

function load_modify_window(id_absence, id_student) {
    for (var i = 0; i < data.length; i++) {
        var id_absence_TEMP = data[i]["id_absence"];
        var id_studient = data[i]["id_etudiant"];        

        var first_name = data[i]["first_name"];
        var comment = data[i]["comment"];
        var date = data[i]["date"];
        var reason = data[i]["reason"];

        if (id_absence_TEMP == id_absence) {
            $("#edit #id_absence").val(id_absence);
            $("#edit #id_student").val(id_studient);            

            $("#edit #student-name").val(first_name);
            $("#edit #date").val(date);
            $("#edit #subject").val(comment);
            $("#edit #reason").val(reason);

            break;
        }
    }
}