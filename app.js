

//document.write(" -- Hi swapnil Here");
// var content = fs.readFileSync('./package.json','utf8');
// document.write(content);

var app = require('electron').remote;

var index = app.require('./index.js');
var fs = require('fs');
var dialog = app.dialog;
var store_filepath = '';
var content = '';
var fill = '';


//to create a new file
document.getElementById("create-file").addEventListener('click', function () {
    dialog.showSaveDialog(function (fileName) {
        if (fileName === undefined) {
            console.log("You didn't create the file");
            return;
        }
        // fileName is a string that contains the path and filename created in the save file dialog.
        content = '';
        fs.writeFile(fileName, content, function (err) {
            if (err) {
                alert("An error ocurred creating the file " + err.message)
            }
            document.getElementById("actual-file").value = fileName;
            store_filepath = fileName;
            document.getElementById("content-editor").value = content;
            alert("The file has been succesfully created");
        });
    });
});


//to select a file
document.getElementById('select-file').addEventListener('click', function () {
    dialog.showOpenDialog(function (fileNames) {
        if (fileNames === undefined) {
            console.log("No file selected");
        } else {
            document.getElementById("actual-file").value = fileNames[0];
            store_filepath = fileNames[0];
            readFile(fileNames[0]);
        }
    });
}, false);

//function for reading file
function readFile(filepath) {
    fs.readFile(filepath, 'utf-8', function (err, data) {
        if (err) {
            alert("An error ocurred reading the file :" + err.message);
            return;
        }
        // Change how to handle the file content
        content = data;
      //  console.log("The file content is : " + data);
        document.getElementById("content-editor").value = content;
    });
}


// saving newly added changes
document.getElementById("save-changes").addEventListener('click', function () {

    var new_content = document.getElementById("content-editor").value;
    fs.writeFile(store_filepath, new_content, function (err) {
        if (err) {
            alert("An error ocurred updating the file" + err.message);
            console.log(err);
            return;
        }

        alert("The file has been succesfully saved");
    });
})

//deleting a file
document.getElementById("delete-file").addEventListener('click', function () {
    fs.exists(store_filepath, function (exists) {
        if (exists) {
            // File exists deletings
            fs.unlink(store_filepath, function (err) {
                if (err) {
                    alert("An error ocurred updating the file" + err.message);
                    console.log(err);
                    return;
                }
                document.getElementById("actual-file").value = fill;
                document.getElementById("content-editor").value = fill;
                alert("File succesfully deleted");
            });
        } else {
            alert("This file doesn't exist, cannot delete");
        }
    });

})

  document.getElementById('Encrypt_it').addEventListener('click', function () {

        var request = require('request');
        var id;
        var content;
        content = document.getElementById('content-editor').value;
        //console.log(content);
        request("http://localhost/encrypto/encrypto.php?id="+content+"&process=encrypt", function (error, response, body) {
            if (!error && response.statusCode == 200) {
                console.log(body) // Show the HTML for the Google homepage.
                document.getElementById('content-editor').value = body;
            }
        })

    });

    document.getElementById('decrypt_it').addEventListener('click',function(){

    var request = require('request');
    var content;
    content=document.getElementById('content-editor').value;
        request("http://localhost/encrypto/encrypto.php?id="+content+"&process=decrypt",function(error,response, body){
      console.log(body);
      document.getElementById('content-editor').value = body;
    });

    });


    document.getElementById('Encrypt_it').addEventListener('click',function(){
      swal({
            title: "Verification",
            text: "E-mail:",
            type: "input",
            showCancelButton: true,
            closeOnConfirm: false,
            animation: "slide-from-top",
            inputPlaceholder: "User-Email"
        },
        function(inputValue){
            if (inputValue === false) return false;
            if (inputValue === "") {
                swal.showInputError("Error");
                return false;
            }
            swal({
                title: "Verification",
                text: "Password",
                type: "input",
                showCancelButton: true,
                closeOnConfirm: false,
                animation: "slide-from-top",
                inputPlaceholder: "Password"
            },
            function(inputValue){
                if (inputValue === false) return false;
                if (inputValue === "") {
                    swal.showInputError("E-mail error");
                    return false;
                }
                swal("Nice!", "You wrote: " + inputValue, "success");
            });
        });

    });
