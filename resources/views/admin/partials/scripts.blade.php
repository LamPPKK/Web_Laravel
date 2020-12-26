<script>
    // $(function () {
    //     // $( "#sortable2" ).sortable();
    //     // $( "#sortable2" ).disableSelection();
    //     jQuery("#contentFacebook").emojioneArea({
    //         pickerPosition: "left",
    //         tonesStyle: "bullet"
    //     });

    //     $('#user').DataTable();

    //     //Initialize Select2 Elements
    //     // $('.select2').select2()
    //     $('.select2').select2({width: '100%'})

    //     //Flat red color scheme for iCheck
    //     $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
    //         checkboxClass: 'icheckbox_flat-green',
    //         radioClass: 'iradio_flat-green'
    //     })
    //     $('.editor').each(function (e) {
    //         CKEDITOR.replace(this.id, {
    //             filebrowserImageBrowseUrl: '/kcfinder-master/browse.php?type=images&dir=images/public',
    //         });
    //     });

    //     $('#reservationtime').daterangepicker({
    //         timePicker: true,
    //         timePickerIncrement: 30,
    //         locale: {
    //             format: 'MM/DD/YYYY h:mm A'
    //         }
    //     });

    // });


    function uploadImage(e) {
        window.KCFinder = {
            callBack: function (url) {
                window.KCFinder = null;
                var img = new Image();
                img.src = url;
                $(e).next().next().empty();
                $(e).next().next().append('<img src="' + url + '" width="80" height="70"/>');

                $(e).next().val(url);


            }
        };
        window.open('/kcfinder-master/browse.php?type=images&dir=images/public',
            'kcfinder_image', 'status=0, toolbar=0, location=0, menubar=0, ' +
            'directories=0, resizable=1, scrollbars=0, width=800, height=600'
        );
    }

    function openKCFinder(e) {
        window.KCFinder = {
            callBackMultiple: function (files) {
                window.KCFinder = null;
                var urlFiles = "";
                $(e).next().empty();
                for (var i = 0; i < files.length; i++) {
                    $(e).next().append('<img src="' + files[i] + '" width="80" height="70" style="margin-left: 5px; margin-bottom: 5px;"/>')
                    urlFiles += files[i];
                    if (i < (files.length - 1)) {
                        urlFiles += ',';
                    }
                }

                $(e).next().next().val(urlFiles);
            }
        };
        window.open('/kcfinder-master/browse.php?type=images&dir=images/public',
            'kcfinder_multiple', 'status=0, toolbar=0, location=0, menubar=0, ' +
            'directories=0, resizable=1, scrollbars=0, width=800, height=600'
        );
    }
    function sweertAlert(title,text,type) { 
       
        swal.fire({
            'title': title,
            'text':text,
            'type': type
        })
    }
</script>