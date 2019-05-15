# Bystanders to Genocide

An Android-web dual application allowing bystanders to genocide and to safely upload documentation of crimes against humanity. Made in solidarity with the victims of the ongoing genocide in Ambazonia, and in loving memory of Sam Soya.

Please note that the version found in the master branch is the original submission. The contents of the
'strip-dependencies' branch are a refactored version of the website that does not rely on any PHP extensions. This
version was created due to the lack of suitable PHP server hosts, as all that we tried with could not run the
required extensions.

# Website

## Release Notes (v1.0)

This is the first release of the website, with the following base features:

* Allows users to query the database storing the Android app users’ uploads by county and document type
* Keeps users up-to-date on the state of the genocide via downloadable PDF documents and the death count displayed on the home screen
* Enables users to engage with the Ambazonian interim government through social media

There are no known bugs or defects thus far in development.

The website uses Google’s Firebase as its basis for data storage and querying. The PDF documents available for download can be modified by visiting the Firebase console and navigating to the “Storage” module; all PDF links are generated from the top-level directory.

## Install Guide

The website is designed to be served by a generic PHP server with modules accessible by Composer and PECL, PHP’s primary package management utilities. The following packages/extensions are dependencies that need to be installed for the website to be served properly:

* PHP 7.0 Development Kit
* PHP Pear
* PHP Unit
* Composer
* GRPC (extension)
* Protobuf (extension)

For the purposes of testing/emulation, we provide a short guide to hosting the website locally below, using the appropriate commands for a Debian-based system.

PHP 7.0, Pear, Unit, and Composer can all be installed using standard package management utilities. On a Debian system, for example, these packages can be installed with the command `sudo apt-get install php7.0-dev php-pear phpunit composer`.

To install the GRPC and Protobuf extensions, run `sudo pecl install grpc` and `sudo pecl install protobuf` from the command line (requires PHP Pear) and the following lines to the php.ini file:
```
extension=grpc.so
extension=protobuf.so
```

Finally, navigate to the website install directory (i.e., the directory containing the files downloaded from GitHub), run `composer update` and copy in the auth.json file used to authenticate database accesses. Please contact us to receive the auth.json file.

The server can be started from the command-line using `php7.0 -S localhost:13000`, for example, for local testing/emulation.

## Future Work

We included several blank pages in the website labeled “under construction.” These are included so that future work may be based in those pages.

# Android

The Android GitHub repository can be found [here](https://github.com/DoctorPepper/CameroonApp).

## Release Notes (v1.0)

The application has the following features:

* Can capture photo, video, and audio recordings and upload them to the website’s database
* Ensures user safety by never saving photo and audio captures, and deleting video after it has been uploaded and allowing the user to set a passcode for accessing the application
* Allows users to set another application to be opened upon the entry of an incorrect passcode and also lets users set their county through the settings menu

Known bugs:

* Android back button has unexpected behavior in some scenarios (i.e., after uploading a document and going back to the document selection screen, the back button takes the user back to the upload confirmation screen)

## Install Guide

To begin, navigate to our "CameroonApp" GitHub page, click "Clone or download" in the top-right, and click "Download ZIP." Afterwards, navigate to where the .zip file was downloaded, right click on it, and unzip it. 

In order to install the app onto a device, simply do the following:

* Plug your device into the computer on which the app source files were downloaded.
* If you get a pop-up on your computer asking what you want to do with your device, select 'Transferring files' or something similar.
* Next, navigate to the source files on your computer.
* Find the "Game Manager.apk" file in the top directory ".../CameroonApp/Game Manager.apk"
* Move this .apk onto your smartphone device.
* Open the .apk file on your device using your device's native file manager. This likely involves going into an app called 'Files' navigating to whenever you moved the .apk file, then tapping on the .apk file.
* Finally, you'll be asked to install the application. Select 'Install', and you're good to go!
