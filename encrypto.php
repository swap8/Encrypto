<?php


$hostname = 'localhost';
$username = 'root';
$password = '';
$database = 'encrypto';

try {

  $conn = new PDO("mysql:host = $hostname;dbname=$database",$username,$password);
  $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
  //echo 'connected successfully';
} catch (PDOException $e) {

  echo "connection failed.";

}


$stmt = $conn->query('select * from encrypt where userid=1 or 2');
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

//print_r($result);

for($i=0;$i<sizeof($result);$i++){
  $temp = $result[$i];
  //echo $temp['userid'];
}




//let's create  first some string which will return some value on calling
$id;
$i=0;
$process = $_GET['process'];

$id = $_GET['id'];
$email = $_GET['email'];
//$email="swapnil";
$password = $_GET['password'];
//$password = "asdfg";
//$id = "my name is swapnil";
//echo $id;
if(isset($id)&& $process==="encrypt" && isset($email)&& isset($password)){
  $allow_en_access = 0;
$photon = 'abcdefghijklmnopqurstvwxyzj4646464684';
$temp=$id;
$k=0;
for($i=0;$i<strlen($id);$i++){

  if($i%2==0){
    $randomChar = $photon[rand(0, strlen($photon)-1)];
    $first = $photon[rand(0, strlen($photon)-1)];

    $temp[$k]=$first;
    $k++;
    $temp[$k]=$id[$i];
    $k++;
    $temp[$k]=$randomChar;
    $k++;


  }
  else{
    $temp[$k]=$id[$i];
    $k++;

  }



}
$first_main = $temp;
//echo $first_main;
$final_answer_string='';
global $conn;
  $key = '0123456789';
  $shuffled_key = str_shuffle($key);
  //echo str_shuffle($key);

  $stmt = $conn->query("select * from encrypt where username='$email'");
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
  //print_r($result);

  for($i=0;$i<sizeof($result);$i++){
    $temp = $result[$i];
    //echo "hello";
  //  echo "shuffled key is $shuffled_key";

  //echo '<br>';
  $userid = $temp['userid'];
  //echo '<br>';
  $user_password = $temp['password'];
  if($user_password == $password){
    $allow_en_access = 1;
    $stmt=$conn->query("update encrypt set enkey='$shuffled_key' where userid=$userid");
    $stmt->execute();
  }

  }
  if($allow_en_access){

    //echo $first_main;
  $sample1 = "swapnil";
  $sample  = $first_main;
  $this_sample = "8m8yy 4nkazmweq 8ivs4 ysuwaajpwn4i4l";
  // echo '<br>';
  // echo 'The Sample data is :  '.$sample;
  // echo '<br>';
  // echo 'lets encrypt this';
  // echo 'The key is '.$shuffled_key;

  $string_length=strlen($sample);
  // echo '<br>';
  // echo 'String Length is '.$string_length;
  $super_counter=0;
for($james=0;$james<$string_length;$james++){

      if($james%10==0 && $james>0){
        // echo '<br>';
        // echo 'lets encrypt '.$james.' values';

        $super_counter++;
        $k=$james-10;

        for($i=$james-10;$i<$james;$i++){
          $enc[$k]=$sample[$i];
          $k++;
        }
        // echo '<br>';
        //print_r($enc);


        $k=$james-10;

        $j=0;
        for($i=$james-10;$i<$james;$i++){
          //shift the characters over key position
          $answer[$k] = $enc[$i];
          $first_char_key= $shuffled_key[$j];

          $final_enc[$first_char_key] = $answer[$k];

          $k++;
          $j++;


        }
        $j=0;
        //echo 'lets see the encrypted value : ';
        for($i=$james-10;$i<$james;$i++){
          $new_string[$i] = $final_enc[$j];
        //  echo $new_string[$i];
          $j++;
        }

      //  echo '<br><br>';

      }
    }
      //  echo '<br><br>';
        //just printing encrypted output
      //  echo 'the encrypted string size is '.sizeof($new_string).'is : ' ;

        for($i=0;$i<sizeof($new_string);$i++){
        //  echo $new_string[$i];
        }

        // echo '<br>';
        // echo 'The conversion in string format is : '.$send_string;


        // echo 'the value of super counter is : '.$super_counter;
        // echo '<br>';
        $super_counter=$super_counter*10;
        $remain = strlen($sample)%$super_counter;
        //echo 'remain is : '.$remain;
        if($remain>0){
          for($i=0;$i<$remain;$i++,$super_counter++)
          $new_string[$super_counter] = $sample[$super_counter];
        }
        // echo '<br>';
        // echo 'the encrypted string size is '.sizeof($new_string).' is : ' ;

        for($i=0;$i<sizeof($new_string);$i++){
        //  echo $new_string[$i];
        }

        $send_string = implode($new_string);
       echo $send_string;
        // echo '<br>';
        // echo 'The conversion in string format is : '.$send_string;




  }


}

if(isset($id)&& $process==="decrypt" && isset($email)&& isset($password)){

$allow_access = 0;
//echo $allow_access;
  $stmt = $conn->query("select * from encrypt where username='$email'");
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
  //print_r($result);

  for($i=0;$i<sizeof($result);$i++){
    $temp = $result[$i];
    //echo "hello";
  //  echo "shuffled key is $shuffled_key";
 //print_r($temp);
//  echo '<br>';
  $userid = $temp['userid'];
  //echo '<br>';
  $user_password = $temp['password'];
  //echo $user_password;
  //echo $password;


if($user_password == $password){
$allow_access = 1;
//echo $allow_access;
}
}
//echo $allow_access;
if($allow_access){
  //echo 'ok';
  $stmt=$conn->query("select enkey from encrypt where userid=$userid");
  $stmt->execute();

  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
  //print_r($result);


for($i=0;$i<sizeof($result);$i++){
  $temp = $result[$i];
  //echo "hello";
//  echo "shuffled key is $shuffled_key";
  //print_r($temp);
  $enkey = "enkey";
  $shuffled_key = $temp[$enkey];
  //echo $shuffled_key;
}


        // echo '<br>';
        // echo 'Decryption of above string : ';
        // echo '<br>';
$new_string = $id;
//$new_string = "mpana4n4y mpssgjiue  rprlzaksw6noivl";
        $main_counter=0;
        $k=0;
      //  echo 'size of new string is '.strlen($new_string).'<br>and the string is '.$new_string.'<br>';
        for($scot=0;$scot<=strlen($new_string);$scot++){

          if($scot>0 && $scot%10==0){
            $main_counter++;
            // echo '<br>';
            // echo ' value of scot is : '.$scot;
            $tank=0;
            for($i=$scot-10;$i<$scot;$i++){

              $new_answer[$i] = $new_string[$i];

              $real = $shuffled_key[$tank];

              $real_position[$i] =  $new_string[$real+$scot-10];
              //echo '<br>';
              $tank++;
            //  print_r($real_position);
            }

          }

        }
        //echo ' <br>The decrypted string is : ';
        for($i=0;$i<sizeof($real_position);$i++){
          //  echo $real_position[$i];
        }



        // echo 'the value of main counter is : '.$main_counter;
        // echo '<br>';
        $main_counter=$main_counter*10;
        $remain = strlen($new_string)%$main_counter;
        //echo 'remain is : '.$remain;
        if($remain>0){
          for($i=0;$i<$remain;$i++,$main_counter++)
          $real_position[$main_counter] = $new_string[$main_counter];
        }
        // echo '<br>';
        // echo 'the decrypted string size is '.sizeof($real_position).' is : ' ;

        for($i=0;$i<strlen($new_string);$i++){
        //  echo $real_position[$i];
        }
//echo '<br>';
$id = implode($real_position);
$temp=$id;
$k=0;
$counter=0;
for($k=0;$k<strlen($id);$k++){
//echo " value of k : $k ";
  if($k%2!=0){

    $temp[$counter]=$id[$k];
    $counter++;
    //echo " $temp";


  }
  else{
    //echo " value of k : $k ";
  }
  //echo " $temp";


}
//echo $temp;
$sam=array();

for($i=0;$i<$counter;$i++){

  array_push($sam,$temp[$i]);
}
foreach($sam as $result) {
  echo $result;
}

}



}


?>
