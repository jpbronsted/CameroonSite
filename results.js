var config = {
    apiKey: "AIzaSyDNZPsyBA-NyyTZxUGo5CesX4aK-7jpEC4",
    authDomain: "cameroonsite-5f7e2.firebaseapp.com",
    databaseURL: "https://cameroonsite-5f7e2.firebaseio.com",
    projectId: "cameroonsite-5f7e2",
    storageBucket: 'gs://cameroonsite-5f7e2.appspot.com/'
};

firebase.initializeApp(config);

var storage = firebase.app().storage();
var db = firebase.firestore();

function initialize(){
    var doctype = document.getElementById('doctype').value;
    var province = document.getElementById('province').value;

    get_storage_bucket(doctype, province);
}

function get_storage_bucket(doctype, province){
    var storage_url = 'gs://cameroonsite-5f7e2.appspot.com/';

    if(doctype === 'Photos') {
        storage_url += 'Photos';

        if(province !== 'all') {
            storage_url += '/' + province;
        }
    } else if(doctype === 'Videos') {
        storage_url += 'Videos';

        if(province !== 'all') {
            storage_url += '/' + province;
        }
    } else if(doctype === 'Audio Recordings') {
        storage_url += 'Recordings';

        if(province !== 'all') {
            storage_url += '/' + province;
        }
    } else if( province !== 'all' ) {
        storage_url += 'Photos/' + province;
        storage = firebase.app().storage(storage_url)
        display_documents();

        storage_url += 'Videos/' + province;
        storage = firebase.app().storage(storage_url)
        display_documents();

        storage_url += 'Recordings/' + province;
    }

    storage = firebase.app().storage(storage_url)
    display_documents();
}

function display_documents() {
}

function submit_form(name, id, form) {
  document.getElementById(id).value = name;
  form.submit();
}
