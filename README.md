
# CUNY Job Posts

A WordPress plugin to display job postings for any CUNY college that provides a compatible JSON job feed. The plugin uses the `[cunyc_job_posts]` shortcode to display current job openings on your WordPress site.

## Features

- Displays current job postings from any CUNY college via their provided job feed URL.
- Shortcode usage: `[cunyc_job_posts]` displays the job postings from the default URL.
- Customizable college job feed URL with the shortcode: `[cunyc_job_posts college_url="https://example.com/jobs/feed/json"]`.
- Supports job title, date posted, job ID, description, and application links for current CUNY employees and external applicants.
- Easy to integrate into any WordPress page or post using the shortcode.

## Installation

### 1. Download the Plugin

- Download the plugin from the GitHub repository or manually install it on your WordPress website.

### 2. Install via WordPress Dashboard

1. Go to the WordPress Dashboard.
2. Navigate to **Plugins > Add New**.
3. Click on **Upload Plugin** and select the ZIP file for the plugin.
4. Click **Install Now** and then **Activate**.

### 3. Manual Installation

1. Download the plugin files and unzip them.
2. Upload the plugin folder to your `/wp-content/plugins/` directory on your WordPress server.
3. Go to the **Plugins** section in your WordPress dashboard and click **Activate** next to **CUNY Job Posts**.

## Usage

To display job postings, use the `[cunyc_job_posts]` shortcode anywhere on your WordPress site, such as in a page, post, or widget.

### Example:

To display the default job postings for CUNY colleges:

```plaintext
[cunyc_job_posts]
```

### Custom College URL:

You can specify a custom job feed URL by passing it as an attribute:

```plaintext
[cunyc_job_posts college_url="https://example.com/jobs/feed/json"]
```

Replace `https://example.com/jobs/feed/json` with the actual JSON feed URL of the CUNY college you want to display job postings for.

## Configuration

- **Default Job Feed URL**: If no `college_url` attribute is provided, the plugin will fetch job postings from a default CUNY college job feed.
- **Shortcode Attribute**: The `college_url` attribute allows the plugin to fetch job postings from other CUNY colleges by providing their job feed URL.

## Enqueued Scripts and Styles

The plugin registers and enqueues the following files:

- `cuny-jp-script.js`: A JavaScript file for handling interactions such as toggling the job details.
- `cuny-jp-style.css`: A CSS file for styling the job posts.

Both files are registered and enqueued when the plugin is activated.

## File Structure

```
cunyc-job-posts/
│
├── index.php                  # Main template for displaying job posts
├── js/
│   └── cuny-jp-script.js     # JavaScript file for interactive elements
├── css/
│   └── cuny-jp-style.css     # CSS file for styling job posts
├── cunyc-job-posts.php        # Main plugin file
├── README.md                  # This file
└── LICENSE                    # GPL-2.0 License file
```

## License

This plugin is licensed under the **MIT** license.

## Credits

- Developed by Milla Wynn.
- Plugin uses WordPress functions and API for integration.

## Support

If you encounter any issues or have questions about the plugin, please open an issue on the [GitHub repository](https://github.com/millaw).

## Changelog

### 1.0.0
- Initial release with functionality to fetch and display job postings using a JSON feed URL.
- Shortcode to display job postings `[cunyc_job_posts]`.
- Custom URL support for job feeds.
