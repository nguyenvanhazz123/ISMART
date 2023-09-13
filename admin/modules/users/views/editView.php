<?php 
show_array($user);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<table border="1px" cellspacing="0" cellpadding="">
            <thead>
                <tr>
                    <th>Tên</th>
                    <th>Email</th>
                    <th>Tuổi</th>
                    <th>Thu nhập</th>
                </tr>
            </thead>
            <tbody>
                    <tr>
                        <td><?php echo $user['fullname'] ?></td>
                        <td><?php echo $user['email'] ?></td>
                        <td><?php echo $user['age'] ?></td>
                        <td><?php echo currency_format($user['earn'], '$'); ?></td>
                    </tr>
            
        
            </tbody>
        </table>
</body>
</html> 