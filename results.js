var config = {
    apiKey: "AIzaSyDNZPsyBA-NyyTZxUGo5CesX4aK-7jpEC4",
    authDomain: "cameroonsite-5f7e2.firebaseapp.com",
    databaseURL: "https://cameroonsite-5f7e2.firebaseio.com",
    projectId: "cameroonsite-5f7e2",
    storageBucket: 'gs://cameroonsite-5f7e2.appspot.com/'
};

firebase.initializeApp(config);

var storage = firebase.app().storage();
var storage_ref = storage.ref();
var db = firebase.firestore();

function initialize(){
    var doctype = document.getElementById('doctype').value;
    var province = document.getElementById('province').value;

    get_documents(doctype, province);
}

function get_documents(doctype, province){
    var url = 'counties';
    var documents_array = [];
    var doc_url_array = [];

    if(province !== 'all') {
        url += '/'+province;
    }

    var docRef = db.doc(url);

    docRef.get().then( function(doc) {
        if( doctype !== 'Show All Documents') {
            if(doctype === 'Audio Recordings'){
                doctype = 'Recordings';
            }
            documents_array = doc.get(doctype);
            documents_array.forEach(function(document) {
               storage_ref.child(document).getDownloadURL().then(function(url) {
                 doc_url_array.push(url);
                 document.getElementById('documents').innerHTML = doc_url_array[0];
                 var xhr = new XMLHttpRequest();
                 xhr.responseType = 'blob';
                 xhr.onload = function(event) {
                   var blob = xhr.response;
                 };
                 xhr.open('GET', url);
                 xhr.send();

                 document.getElementById('myimg').src = url;
               }).catch(function(error) {
                 // Handle any errors
               });
            });
        } else {
            documents_array = doc.get('Photos');
            Array.prototype.push.apply(documents_array, doc.get('Videos'));
            Array.prototype.push.apply(documents_array, doc.get('Recordings'));
        }
    })
    .catch(function(error) {
        console.log("Error getting documents: ", error);
    });


    if(doctype === 'Photos') {
        url += 'Photos';

        if(province !== 'all') {
            url += '/' + province;
        }
    } else if(doctype === 'Videos') {
        url += 'Videos';

        if(province !== 'all') {
            url += '/' + province;
        }
    } else if(doctype === 'Audio Recordings') {
        url += 'Recordings';

        if(province !== 'all') {
            url += '/' + province;
        }
    }
}

function display_documents() {
}

function submit_form(name, id, form) {
  document.getElementById(id).value = name;
  form.submit();
}
