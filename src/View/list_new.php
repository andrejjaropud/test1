<?php
$arrRecord = json_encode($records);
?>
<table id="test1" class="display">
</table>
<script type="text/javascript">
    var dataSet = <?php echo $arrRecord; ?>;
    $(document).ready(function() {
        $('#test1').DataTable( {
            data: dataSet,
            columns: [
                { title: "User Name",data:"username" },
                { title: "User Firstname", data:"firstname" },
                { title: "User Lastname", data:"lastname" },
                { title: "Country", data:"country" },
                { title: "Rating", data:"rate" },
                { title: "Data registrationy", data:"dataregistration" }
            ]
        } );
    } );
</script>
