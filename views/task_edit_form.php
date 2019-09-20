<form class="taskform" action="" method="post">
    Description
    <input type="text" name="description"  autocomplete="off" required value="<?=$description?>">
    Code
    <textarea name="code" rows="30" required><?=$code?></textarea>
    <input type="submit" name="save" value="Save">
</form>