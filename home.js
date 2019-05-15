// Initialize Firebase connection
firebase.initializeApp({
  apiKey: "AIzaSyDNZPsyBA-NyyTZxUGo5CesX4aK-7jpEC4",
  authDomain: "cameroonsite-5f7e2.firebaseapp.com",
  databaseURL: "https://cameroonsite-5f7e2.firebaseio.com",
  projectId: "cameroonsite-5f7e2",
  storageBucket: "cameroonsite-5f7e2.appspot.com",
  messagingSenderId: "626188095181",
  appId: "1:626188095181:web:4c32d3feab5e8193"
});
var firestore = firebase.firestore();
var storage = firebase.storage().ref();

// Fetch the info document and fill in relevant data
firestore.collection('info').doc('info').get().then(function(doc) {
  // Resolve if we found the document; throw an error otherwise
  if (doc.exists)
    return doc.data();
  else
    throw new Error('Info document not found');
}).then(function(info) {
  // Get the deathcount and insert it in the deathcount button text
  document.getElementById('deathcount').innerHTML = 'Death Count : '
      + info.deathcount;
  // Get a download URL for the home screen image
  storage.child(info.home_screen_image).getDownloadURL().then(function(url) {
    document.getElementById('home-page-img').src = url;
  });
  // Dynamically generate download links for the pdfs
  info.pdfs.forEach(function(pdf) {
    storage.child(pdf).getDownloadURL().then(function(url) {
      let node = document.createElement('A');
      node.classList.add('btn');
      node.classList.add('btn-outline-dark');
      node.href = url;
      node.innerHTML = pdf;
      node.target = '_blank';
      node.download = pdf;
      document.getElementById('pdf-container').appendChild(node);
    });
  });
}).catch(function(error) {
  console.log('Error processing info document: ' + error);
});

// Populate the social media links
firestore.collection('socialmedia').get().then(function(docs) {
  docs.forEach(function(doc) {
    let data = doc.data();
    let node = document.createElement('A');
    node.classList.add('btn');
    node.classList.add('btn-outline-dark');
    node.href = data.url;
    node.target = '_blank';
    node.innerHTML = data.name;
    document.getElementById('social-media-container').appendChild(node);
  });
}).catch(function(error) {
  console.log('Error processing social media documents: ' + error);
});
