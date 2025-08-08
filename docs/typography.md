# Typography Settings

The **Typography** section of the Yii2 Admin Theme Extension allows administrators to customize font styles and sizes used across the backend interface. These settings provide flexibility and improve the visual aesthetics and readability of the admin panel.

## 🔤 Font Family

You can choose from a curated list of widely-used web fonts. Each font is displayed in its own style for better preview and selection.

### Supported Fonts:
- **Roboto** (default)
- **Open Sans**
- **Lato**
- **Montserrat**
- **Poppins**
- **Source Sans Pro**
- **Arial**
- **Tahoma**

> 💡 Most fonts are loaded via Google Fonts with graceful fallbacks like `sans-serif`.

## 🔠 Font Size

Font size options range from small to large to accommodate accessibility and design preferences.

### Available Sizes:
| Label     | Value   |
|-----------|---------|
| Extra Small | `0.5rem` |
| Small       | `0.75rem` |
| Normal      | `1rem` *(default)* |
| Large       | `1.25rem` |
| Extra Large | `1.5rem` |

## 🧩 Implementation

The selected typography settings are stored in the `admin_theme_setting` table and dynamically applied via CSS variables or inline styles.

## 📁 Storage

These preferences are stored alongside other appearance settings in the database and are automatically applied on each admin panel load.

## ✍️ Extending

You may easily add more fonts by:
- Updating the dropdown in the settings form
- Including the required Google Fonts link in your layout

---

- [Appearance Settings](appearance.md)
- [Branding & Logos](branding_logo_upload.md)
- [README.md](../README.md)