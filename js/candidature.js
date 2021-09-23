$(document).ready(function () {

    fetch_data();

    function fetch_data() {
        var dataTable = $('#user_data').DataTable({
            "processing": true,
            "serverSide": true,
            "order": [],
            "ajax": {
                url: "actions/action_candidature.php",
                type: "POST",
                data:{
                    action:4,
                }
            }
        });
    }

    function update_data(id, column_name, value) {
        $.ajax({
            url: "actions/action_candidature.php",
            method: "POST",
            data: {
                id: id,
                column_name: column_name,
                value: value,
                action:2
            },
            success: function (data) {
                $('#alert_message').html('<div class="alert alert-success">' + data + '</div>');
                $('#user_data').DataTable().destroy();
                fetch_data();
            }
        });
        setInterval(function () {
            $('#alert_message').html('');
        }, 5000);
    }

    $(document).on('blur', '.update', function () {
        var id = $(this).data("id");
        var column_name = $(this).data("column");
        var value = $(this).text();
        update_data(id, column_name, value);
    });

    $('#add').click(function () {
        var html = '<tr>';
        html += '<td contenteditable id="data1"></td>';
        html += '<td contenteditable id="data2"></td>';
        html += '<td contenteditable id="data3"></td>';
        html += '<td contenteditable id="data4"></td>';
        html += '<td contenteditable id="data5"></td>';
        html += '<td contenteditable id="data6"></td>';
        html += '<td contenteditable id="data7"></td>';
        html += '<td contenteditable id="data8"></td>';
        html += '<td contenteditable id="data9"></td>';
        html += '<td><button type="button" name="insert" id="insert" class="btn btn-success btn-xs">Insert</button></td>';
        html += '</tr>';
        $('#user_data tbody').prepend(html);
    });

    $(document).on('click', '#insert', function () {
        var Poste = $('#data1').text();
        var Entreprise = $('#data2').text();
        var Ref_ann = $('#data3').text();
        var Methode_rel = $('#data4').text();
        var Date_rel = $('#data5').text();
        var Email = $('#data7').text();
        var Reponse = $('#data8').text();
        var Date_reponse = $('#data9').text();
        if (Poste != '' && Entreprise != '' && Ref_ann != '') {
            $.ajax({
                url: "actions/action_candidature.php",
                method: "POST",
                data: {
                    Poste: Poste,
                    Entreprise: Entreprise,
                    Ref_ann: Ref_ann,
                    Methode_rel: Methode_rel,
                    Date_rel: Date_rel,
                    Email: Email,
                    Reponse: Reponse,
                    Date_reponse: Date_reponse,
                    action:1
                },
                success: function (data) {
                    $('#alert_message').html('<div class="alert alert-success">' + data + '</div>');
                    $('#user_data').DataTable().destroy();
                    fetch_data();
                }
            });
            setInterval(function () {
                $('#alert_message').html('');
            }, 7000);
        } else {
            alert("Both Fields is required");
        }
    });

    $(document).on('click', '.delete', function () {
        var id = $(this).attr("id");
        if (confirm("Êtes-vous sûr de vouloir supprimer cette candidature ?")) {
            $.ajax({
                url: "actions/action_candidature.php",
                method: "POST",
                data: {
                    id: id,
                    action:3
                },
                success: function (data) {
                    $('#alert_message').html('<div class="alert alert-success">' + data + '</div>');
                    $('#user_data').DataTable().destroy();
                    fetch_data();
                }
            });
            setInterval(function () {
                $('#alert_message').html('');
            }, 5000);
        }
    });
});