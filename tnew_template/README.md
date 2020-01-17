# TNEW Template

This file is the theme template for Tessitura's TNEW Web System. It is used for all content at [my.thinkeryaustin.org](https://my.thinkeryaustin.org).

It's designed to be the header, footer, css, and js needed to render a page. There is a placeholder section where TNEW will inject their page content.

## Updating the Template

If Thinkery updates the nav menu items, header, or footer, update this file as well.

The easiest method is to copy and paste the relevant HTML from a WordPress page. If you copy & paste, please remove any unneeded js or css files and remove jQuery core. Then replace all the content in the `<article>` tag with the blob from Specific Rule #3.

TNEW loads FontAwesome v4. Thinkery uses FontAwesome 5. If you copy new content from the WordPress site, you *must* update all FontAwesome references to the old, v4 format.

## Specific Rules

1. Do not include the following resources in the template. TNEW will inject those files themselves.
    - jQuery Core
    - Bootstrap
    - FontAwesome
2. Make sure that all links are absolute links to the production url.
3. Include a section modeled like below in the template to tell TNEW where to inject their content.

    ```html
    <section class="content-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mx-auto">
                    <!-- TNEW Content Here -->
                </div>
            </div>
        </div>
    </section>
    ```

## Relevant Links

- [Tessitura documentation on site templates](https://www.tessituranetwork.com/TNEW_7/TNEW.htm#Topics/Self-Hosted_Templates.htm)
- [Example site template](https://www.asolorep.org/templates/tessitura)
