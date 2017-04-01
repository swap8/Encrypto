
const electron = require('electron');

const {app, BrowserWindow} = electron;

app.on('ready', function () {

    var mainWindow = new BrowserWindow({
        width: 1200,
        height: 800
    })

    mainWindow.loadURL('File://' + __dirname + '/index.html');
});

exports.displaymessage = function () {
    var mainWindow = new BrowserWindow({
        width: 400,
        height: 200
    })
    mainWindow.loadURL('File://' + __dirname + '/message.html');

}
