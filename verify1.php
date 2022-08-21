<?php
    require("connection.php");
    //$server ='localhost';
	//$username = 'root';
	//$password =  '';
	//$db = 'bi';

	//$con = mysqli_connect($server, $username, $password, $db);

    if(isset($_GET['email']) && isset($_GET['v_code']))
    {
        $query="SELECT * FROM `rd` WHERE `Email`='$_GET[email]' AND `verification_code`='$_GET[v_code]'";
        $result = mysqli_query($connection,$query);
        if($result)
        {
            if(mysqli_num_rows($result)==1)
            {
                $result_fetch = mysqli_fetch_assoc($result);
                if($result_fetch['is_verified']==0)
                {
                    $update = "UPDATE `rd` SET `is_verified`='1' WHERE `Email`='$result_fetch[Email]'";
                    if(mysqli_query($connection,$update))
                    {
                        echo"
                        <script>
                        alert('Email verification successful');
                        window.location.href='request.php';
                        </script>
                        ";
                    }
                    else
                    {
                        echo"
                        <script>
                        alert('Cannot run query');
                        window.location.href='request.php';
                        </script>
                        ";
                    }
                }
                else
                {
                    echo"
                    <script>
                    alert('Email already verified');
                    window.location.href='request.php';
                    </script>
                    ";
                }
            }
        }
        else
        {
            echo"
            <script>
            alert('Cannot run query');
            window.location.href='request.php';
            </script>
            ";
        }
    }
?>