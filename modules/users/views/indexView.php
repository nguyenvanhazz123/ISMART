<?php
get_header();
// show_array($list_users);
?>

<div id="content">
    <h1>Danh sách thành viên</h1>
    <table border="1px" cellspacing="0" cellpadding="20px">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Tên</th>
                    <th>Email</th>
                    <th>Tuổi</th>
                    <th>Thu nhập</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($list_users)) {
                    $t = 0;
                    foreach ($list_users as $user) {
                        $t ++;
                        ?>
                        <tr>
                            <td><?php echo $t; ?></td>
                            <td><?php echo $user['fullname'] ?></td>
                            <td><?php echo $user['email'] ?></td>
                            <td><?php echo $user['age'] ?></td>
                            <td><?php echo currency_format($user['earn'], '$'); ?></td>
                            <td><a href="?mod=users&controller=index&action=edit&id=<?php echo "{$user['user_id']}" ?>">Edit</a></td>
                            <td><a href="?mod=users&controller=index&action=delete&id=<?php echo "{$user['user_id']}" ?>">Delete</a></td>                           
                        </tr>
                        <?php
                    }
                }
                ?>
        
            </tbody>
        </table>
</div>
<!-- <html>
    <head>
        <title>Danh sách thành viên</title>
        <meta charset="utf8"/>
    </head>
    <body>
        <h1>Danh sách thành viên</h1>
        <table border="1px" cellspacing="0" cellpadding="">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Tên</th>
                    <th>Email</th>
                    <th>Tuổi</th>
                    <th>Thu nhập</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($list_users)) {
                    $t = 0;
                    foreach ($list_users as $user) {
                        $t ++;
                        ?>
                        <tr>
                            <td><?php echo $t; ?></td>
                            <td><?php echo $user['fullname'] ?></td>
                            <td><?php echo $user['email'] ?></td>
                            <td><?php echo $user['age'] ?></td>
                            <td><?php echo currency_format($user['earn'], '$'); ?></td>
                            <td><a href="?mod=users&controller=index&action=edit&id=<?php echo "{$user['user_id']}" ?>">Edit</a></td>
                            <td><a href="?mod=users&controller=index&action=delete&id=<?php echo "{$user['user_id']}" ?>">Delete</a></td>
                        </tr>
                        <?php
                    }
                }
                ?>
        
            </tbody>
        </table>
    </body>
</html> -->
<?php 
get_footer();
?>