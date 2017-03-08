<?php
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;

Route::post('/api/build', function () {
    $buildUrlRoute = secure_url('api/build');
    $publicUrl = secure_url('/');
    $branch = Input::get('branch');
    $file = Input::file('file');
    $bundleVersionNumber = request()->input('build_version_number');
    echo "branch: {$branch}";
    echo "\nfile: {$file}";
    echo "\nsize of file: {$file->getSize()}";
    echo "\nbundle version number: " . $bundleVersionNumber;
    echo "\n";
    $appLastUpdated = Carbon::now();
    $pathToBuildDirectory = "builds";

    $iosManifestFileContents = view('ota-distribution-ios::ios-manifest')
        ->with('buildUrlRoute', $buildUrlRoute)
        ->with('publicUrl', $publicUrl)
        ->with('bundleVersionNumber', $bundleVersionNumber)
        ->render();
    //Render the iOS view
    $iosDownloadFileContents = view('ota-distribution-ios::ios-download')
        ->with('appLastUpdated', $appLastUpdated)
        ->with('appVersion', $bundleVersionNumber)
        ->with('urlToManifestFile', route('builds.manifest'))
        ->render();
    //Creates files and places them in a latest folder.
    $latestBuildPath = "{$pathToBuildDirectory}/latest";
    Storage::put("{$latestBuildPath}/manifest.plist", $iosManifestFileContents);
    Storage::put("{$latestBuildPath}/download.html", $iosDownloadFileContents);
    $file->storeAs("{$latestBuildPath}", "build.ipa");
    //Makes duplicate files in a separate bundle version folder for versioning.
    $bundleVersionPath = "{$pathToBuildDirectory}/{$bundleVersionNumber}";
    Storage::put("{$bundleVersionPath}/manifest.plist", $iosManifestFileContents);
    Storage::put("{$bundleVersionPath}/download.html", $iosDownloadFileContents);
    $file->storeAs($bundleVersionPath, "build.ipa");
});

Route::get('/api/build', function(){
    $directory = "builds/latest";
    $buildFile = Storage::exists("{$directory}/build.ipa");
    if ($buildFile == false) {
        //TODO: Return a view instead
        return "There are no builds available";
    }
    return Storage::get("{$directory}/download.html");
});

Route::get('/api/manifest', function() {
    return Storage::get("builds/latest/manifest.plist");
})->name("builds.manifest");