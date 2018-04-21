<?php
session_start();  
        
function login(){
    echo '<table>
        <form method="post" action="">
            <tr>
                <td>Username</td><td><input type="text" name="user"></td>
            </tr>
            <tr>
                <td>Password</td><td><input type="text" name="pass"></td>
            </tr>
            <tr>
                <td></td><td><input type="submit" name="submit" value="Login"></td>
            </tr>
        </form>
    </table>';
}

        if($_POST['user']=="user" && $_POST['pass']=="123")
        {
            // disini code ketika login berhasil
            // abaikan saja karna pembahasan kali ini adalah ketika login gagal  
        }
        else
        {
            //jika terdapat session bernama "auth"
            //untuk penamaan session bebas ya, mau "auth", "cemungud", "follback_kaka" terserah :D
            if(isset($_SESSION['auth']))
            {
                //jika user gagal masuk selama 3 kali atau lebih
                if($_SESSION['auth']>3 || $_SESSION['auth']==3){
                        //set nilai session "auth" ke 4
                        $_SESSION['auth']=4;
                        //jalankan function blokir_user
                        blokir_user();
                }
                //jika tidak
                else{
                        //session "auth" ditambah 1
                        $_SESSION['auth']=$_SESSION['auth']+1;
                        //jalankan function login()
                        login();
                }
            }
            //jika tidak ada session "auth"
            else{
                    //daftarkan session "auth", dan beri nilai 1
                    $_SESSION['auth']=1;
                    //jalankan function login()
                    login();
            }
 
        }

function blokir_user(){
    echo "<h1> Anda telah diblokir ! </h1>";
}
 
//ini script untuk menampilkan brapa kali user mencoba login
if(isset($_SESSION['auth'])){
    echo $_SESSION['auth'];
}