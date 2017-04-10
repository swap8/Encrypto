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

if(isset($id)&& $process==="encrypt"){
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
echo $temp;
}

if(isset($id)&& $process==="decrypt"){
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


decide_position();

// let's decide some position for encryptions NoRewindIterator
function decide_position(){
$final_answer_string='';
global $conn;
  $key = '0123456789';
  $shuffled_key = str_shuffle($key);
  //echo str_shuffle($key);

  $stmt = $conn->query("select * from encrypt where username='amey'");
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
  //print_r($result);

  for($i=0;$i<sizeof($result);$i++){
    $temp = $result[$i];
    //echo "hello";
  //  echo "shuffled key is $shuffled_key";
    $stmt=$conn->query("update encrypt set enkey='$shuffled_key' where userid=2");
    $stmt->execute();
  }

  $sample1 = "swapnil";
  $sample  = "8m8yy 4nkazmweq 8ivs4 ysuwaajpwn4i4l";
  $this_sample = "8m8yy 4nkazmweq 8ivs4 ysuwaajpwn4i4l";
  echo '<br>';
  echo 'The Sample data is :  '.$sample;
  echo '<br>';
  echo 'lets encrypt this';
  echo 'The key is '.$shuffled_key;

  $string_length=strlen($sample);
  echo '<br>';
  echo 'String Length is '.$string_length;
  $super_counter=0;
for($james=0;$james<$string_length;$james++){

      if($james%10==0 && $james>0){
        echo '<br>';
        echo 'lets encrypt '.$james.' values';

        $super_counter++;
        $k=$james-10;

        for($i=$james-10;$i<$james;$i++){
          $enc[$k]=$sample[$i];
          $k++;
        }
        echo '<br>';
        print_r($enc);


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
        echo 'lets see the encrypted value : ';
        for($i=$james-10;$i<$james;$i++){
          $new_string[$i] = $final_enc[$j];
          echo $new_string[$i];
          $j++;
        }

        echo '<br><br>';

      }
    }
        echo '<br><br>';
        //just printing encrypted output
        echo 'the encrypted string size is '.sizeof($new_string).'is : ' ;

        for($i=0;$i<sizeof($new_string);$i++){
          echo $new_string[$i];
        }


        echo 'the value of super counter is : '.$super_counter;
        echo '<br>';
        $super_counter=$super_counter*10;
        $remain = strlen($sample)%$super_counter;
        echo 'remain is : '.$remain;
        if($remain>0){
          for($i=0;$i<$remain;$i++,$super_counter++)
          $new_string[$super_counter] = $sample[$super_counter];
        }
        echo '<br>';
        echo 'the encrypted string size is '.sizeof($new_string).' is : ' ;

        for($i=0;$i<sizeof($new_string);$i++){
          echo $new_string[$i];
        }



        echo '<br>';
        echo 'Decryption of above string : ';
        echo '<br>';


        $main_counter=0;
        $k=0;
        echo 'size of new string is '.sizeof($new_string);
        for($scot=0;$scot<=sizeof($new_string);$scot++){

          if($scot>0 && $scot%10==0){
            $main_counter++;
            echo '<br>';
            echo ' value of scot is : '.$scot;
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
        echo ' The decrypted string is : ';
        for($i=0;$i<sizeof($real_position);$i++){
            echo $real_position[$i];
        }



        echo 'the value of main counter is : '.$main_counter;
        echo '<br>';
        $main_counter=$main_counter*10;
        $remain = sizeof($new_string)%$main_counter;
        echo 'remain is : '.$remain;
        if($remain>0){
          for($i=0;$i<$remain;$i++,$main_counter++)
          $new_string[$main_counter] = $sample[$main_counter];
        }
        echo '<br>';
        echo 'the encrypted string size is '.sizeof($new_string).' is : ' ;

        for($i=0;$i<sizeof($new_string);$i++){
          echo $new_string[$i];
        }














  //let me write logic for decryption also

// echo '<br>';
// echo 'Decryption of above string : ';
// echo '<br>';
// $k=0;
// print_r($final_enc);
// for($i=0;$i<10;$i++){
//
//   $new_answer[$k] = $final_enc[$i];
//   $real = $shuffled_key[$i];
//   echo "value of shuffled key is : ".$real;
//   $real_position[$k] =  $final_enc[$real];
//   echo '<br>';
//   $k++;
//   print_r($real_position);
// }
//
// echo '<br>';
// echo 'The decrypted string is : ';
// for($i=0;$i<10;$i++){
//   echo $real_position[$i];
// }









}
?>
