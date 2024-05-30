# 📁 FileWizard

Features for working with files using PHP.

### 🧰 Installing FileWizard Package

```
composer require mariolucasdev/filewizard
```

### ✔️ Using

#### Upload Single File

```php
use FileWizard\UploadWizard;

$wizard = new UploadWizard();
$file = $wizard::upload('source/file.ext', 'dest/');

// OR

$wizard = new UploadWizard(destination: 'dest/dir/');
$file = $wizard::upload('source/file.ext');

// $file output
// ['name', 'source', 'destination', 'extension', 'size', 'mime']
```

#### Multiple Files

```php
use FileWizard\UploadWizard;

$wizard = new UploadWizard(destination: 'dest/dir/');

$files = $wizard::upload([
    'source/file1.txt',
    'source/file2.txt',
]);

// $files output
// [
//     ['name', 'source', 'destination', 'extension', 'size', 'mime']
//     ['name', 'source', 'destination', 'extension', 'size', 'mime']
// ]
```
