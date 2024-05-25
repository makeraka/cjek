<script>
     function update(){
        alert('dd');

         $('#action_key').val("<?= md5('updateproduit') ?>");
        $('#updateproduct').submit();
    }
    
</script>