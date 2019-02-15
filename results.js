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
    var docRef = db.collection(url);

    if(province !== 'all') {
        url += '/'+province;
        docRef = db.doc(url);
    } else {
        //TODO
    }


    docRef.get().then( function(doc) {
        if( doctype !== 'Show All Documents') {
            if(doctype === 'Audio Recordings'){
                doctype = 'Recordings';
            }
            documents_array = doc.get(doctype);
            documents_array.forEach(function(single_doc) {
                storage_ref.child(single_doc).getDownloadURL().then(function(url) {
                    var table = document.getElementsByTagName('tbody')[0];
                    var row = table.insertRow(0);
                    var link = document.createElement('a');
                    var item = document.createElement('img');

                    item.src = url;
                    link.href = item;
                    link.innerHTML = 'View Document';

                    row.appendChild(link);
                    row.appendChild(item);
               }).catch(function(error) {
                 console.log(error);
               });
            });
        } else {
            documents_array = doc.get('Photos');
            Array.prototype.push.apply(documents_array, doc.get('Videos'));
            Array.prototype.push.apply(documents_array, doc.get('Recordings'));

            documents_array.forEach(function(single_doc) {
                storage_ref.child(single_doc).getDownloadURL().then(function(url) {
                    var table = document.getElementsByTagName('tbody')[0];
                    var row = table.insertRow(0);
                    var link = document.createElement('a');
                    var item = document.createElement('img');

                    link.href = url;
                    link.innerHTML = 'View Document';
                    item.src = url;

                    row.appendChild(link);
                    row.appendChild(item);
               }).catch(function(error) {
                 console.log(error);
               });
            });
        }
    })
    .catch(function(error) {
        console.log("Error getting documents: ", error);
    });
}

function submit_form(name, id, form) {
  document.getElementById(id).value = name;
  form.submit();
}
