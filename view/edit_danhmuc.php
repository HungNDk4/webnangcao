<!DOCTYPE html>
<html>

<body>
    <h1>Cập nhật danh mục</h1>
    <form action="index.php?act=xl_editdm" method="post">
        Tên danh mục: <br>
        <input type="text" name="name" value="<?= htmlspecialchars($danhmuc_edit['name']) ?>">
        <input type="hidden" name="id" value="<?= $danhmuc_edit['id'] ?>">
        <br><br>
        <button type="submit">Update</button>
    </form>
</body>

</html>