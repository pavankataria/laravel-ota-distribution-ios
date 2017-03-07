# Laravel Over-The-Air Distribution for Ios
This package creates the necessary files and routes on your server to cater for the upload of iOS .ipa files and provision the installation of those builds on iOS devices.

## Great, how does it work?
It allows an integration tool to submit an iOS build to your server - where you can act as the host - the package’s service provider creates the routes that 1) handle the submission of the build which in turn create the necessary manifest files, views, and the download page required for over the air distribution for ios devices, and routes to download the build using those generated files.

Note, since iOS 9, over-the-air distribution requires the https protocol or installation will fail.
