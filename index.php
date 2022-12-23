
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            width: 100vw;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        table {
            position: absolute;
            top: 20%;
            width: 80%;
            text-align: center;
        }

        tr {
            height: 50px;
        }

        .header {
            background-color: rgb(57, 57, 57);
            color: white;
        }

        ul {
            display: flex;
            list-style: none;
        }

        li {
            width: 20px;
            height: 20px;
            background-color: rgb(37, 69, 208);
            color: white;
            margin: 0px 5px;
            text-align: center;
            border-radius: 2px;
        }

        .prev{
            width:60px;
            margin:0px 20px;
        }

        a {
            text-decoration: none;
            color: white;
        }
        .pages
        {
            margin-top:20%;
        }
        .active
        {
            background-color:red;
        }
    </style>
</head>

<body>
    <table border="1" cellspacing="0">
        <tr>
            <td colspan="7" class="header">Student Details</td>
        </tr>
        <tr>
            <th>Sid</th>
            <th>Name</th>
            <th>Address</th>
            <th>Class</th>
            <th>Phone</th>
        </tr>
        <?php

            include '../connection.php';

            if(isset($_GET['page'])){
                $page = $_GET['page'];
            }else{
                $page = 1;
            }
            $limit = 3;
            $offset = ($page - 1)*$limit;
           
            $sql = "select * from student join studentclass where student.sclass = studentclass.cid  LIMIT {$offset},{$limit}";
            $result = mysqli_query($conn,$sql);

            if(mysqli_num_rows($result)>0)
            {
                while($row = mysqli_fetch_assoc($result))
                {
?>
        <tr>
            <td><?php echo $row['sid']; ?></td>
            <td><?php echo $row['sname']; ?></td>
            <td><?php echo $row['saddress']; ?></td>
            <td><?php echo $row['sclass']; ?></td>
            <td><?php echo $row['sphone']; ?></td>
        </tr>
        <?php
      }
    }else{
        echo "No Record Found";
    }
?>
</table>

    <ul class="pages">
        <?php
            if($page > 1)
            {
                echo '<li class="prev"><a href="index.php?page='. ($page - 1) .'">Prev</a></li>';
            }
        ?>
        
        <?php
            $sql2 = "select * from student join studentclass where student.sclass = studentclass.cid";
            $result2 = mysqli_query($conn,$sql2);

            $row_count = mysqli_num_rows($result2);
            $pages = ceil($row_count/3);
            
            for($i=1;$i<=$pages;$i++)
            {
                if($page == $i){
                    $active="active";
                }else{
                    $active="";
                }   

                echo "<li class='{$active}'><a href='index.php?page={$i}'>{$i}</a></li>";
            }
        ?>

        <?php
            if($pages > $page)
            {
                echo '<li class="prev"><a href="index.php?page='. ($page + 1) .'">Next</a></li>';
            }
        ?>
    </ul>
</body>

</html>