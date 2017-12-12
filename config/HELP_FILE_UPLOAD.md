Sites : Unsplash

'''
<form enctype="multipart/form-data">
    <input type="file" name="file">
</form>

<?php

$app->post('create',function(Request $request)) {

    $directory = $request->getBasePath() . '/files';
    $file = $request->files->get('file');
    $file->move($directory), 'mon fichier');

}

?>

'''