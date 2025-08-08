
# 🖼️ Branding / Logo Upload

The **Admin Theme Settings** module includes support for uploading branding assets such as logos for both light and dark UI modes.

## 🔧 Supported Logo Types

The module supports the following configurable logo types:

| Setting Key        | Purpose                     |
|--------------------|-----------------------------|
| `logo_light_lg`    | Large logo for light mode   |
| `logo_light_sm`    | Small logo for light mode   |
| `logo_dark_lg`     | Large logo for dark mode    |
| `logo_dark_sm`     | Small logo for dark mode    |

Each file must be in `.png`, `.jpg`, or `.jpeg` format, and no larger than **1MB**.

## 📂 Upload Directory

Uploaded logo images are saved to the following directory:

```
@webroot/uploads/theme/
```

This path resolves relative to the application’s root (e.g., `/var/www/html/uploads/theme/`). The saved filename is automatically generated and unique to prevent conflicts.

Example:

```
/uploads/theme/logo_light_lg_64f1a5d73e2a1.png
```

## 🔁 File Replacement

When a new file is uploaded for any logo setting:

- The previously uploaded file (if any) is deleted automatically.
- The new file is saved with a unique name (e.g., using `uniqid()`).
- The corresponding database entry in the `admin_theme_setting` table is updated.

This ensures clean storage without clutter or orphaned files.

## 🧩 Displaying Uploaded Logos

To use uploaded logos in views, call:

```php
use sahmed237\yii2admintheme\models\AdminThemeSetting;

$logoPath = AdminThemeSetting::get('logo_light_lg'); // Returns web path
```

You can embed it in your HTML:

```php
<img src="<?= $logoPath ?>" class="img-thumbnail" alt="Site Logo">
```

## 🛡️ Security & Validation

- MIME type is validated to accept only `image/jpeg`, `image/jpg`, and `image/png`.
- Maximum file size is enforced both on the client side (`1MB`) and server side.
- File uploads are handled using Yii2's `UploadedFile::getInstanceByName()` and stored safely in a non-public directory (`@webroot/uploads/theme`).

### Fav Icon Upload

You can upload a `.ico` file to be used as the site's fav icon (the small icon displayed in browser tabs).  
The uploaded icon is saved directly in the `@webroot/` directory.

If a new fav icon is uploaded, the previously stored file is automatically deleted to avoid unused files piling up.  
Only `.ico` files are supported, and the recommended size is **32x32** or **48x48** pixels.

