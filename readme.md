# 📁 FileWizard

Features for working with files using PHP.

### 🧰 Installing FileWizard Package

```
composer require mariolucasdev/filewizard
```

### ✔️ Using

#### Upload

```php
use FileWizard\UploadWizard;

$wizard = new UploadWizard();
$dataFile = $wizard::upload('source/file.ext', 'dest/');

// OR

$wizard = new UploadWizard(destination: 'dest/dir/');
$dataFile = $wizard::upload('source/file.ext');

// $dataFile output
// ['name', 'source', 'destination', 'extension', 'size', 'mime']
```
