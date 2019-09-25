<form action="/task/edit/<?=$id?>" method="post">
    Description:
    <input name="description" type="text" value="<?=$description?>" autocomplete="off">
    Code:
    <textarea name="code" rows="10"><?=$code?></textarea>
    <input type="submit" name="">
</form>