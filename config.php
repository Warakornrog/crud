<?define ("DB_SERVER","localhost");
define ("DB_USER","root");
define ("DB_PASSWORD","password");
define ("DB_NAME","EMP");

$link = mysqli_connect(DB_SERVER,DB_USER,DB_PASSWORD,DB_NAME);

if(!$link)
{
    die("ERORR could not connect".mysqli_connect_error());
}
?>