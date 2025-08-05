# Implementation Guide for Scroll Animations

## Quick Implementation Steps

### Step 1: Add CSS Link to index.php

Add this line in the `<head>` section of your `index.php` file, after the existing CSS links:

```html
<!-- Scroll Animations CSS -->
<link rel="stylesheet" href="/animations/main-animations.css?v=1.0" />
```

### Step 2: Add JavaScript Link to index.php

Add this line before the closing `</body>` tag in your `index.php` file:

```html
<!-- Scroll Animations JavaScript -->
<script src="/animations/scroll-animations.js"></script>
```

### Step 3: Verify Section Class Names

Ensure your sections have the correct class names (they should already match):

```html
<!-- Hero Section -->
<section
  class="hero-section py-5 min-vh-100 d-flex align-items-center overflow-hidden position-relative bg-gradient"
>
  <!-- Partners Section -->
  <section class="partners-section py-5 bg-light">
    <!-- About Section -->
    <section id="about" class="py-5 bg-light">
      <!-- Industries Section -->
      <section class="industries-section py-5">
        <!-- Services Section -->
        <section class="featured-services">
          <!-- Brand Potential Section -->
          <section class="brand-potential-section">
            <!-- Who We Serve Section -->
            <section class="who-we-serve">
              <!-- Process Section -->
              <section class="our-process">
                <!-- CTA Section -->
                <section id="cta" class="cta-section"></section>
              </section>
            </section>
          </section>
        </section>
      </section>
    </section>
  </section>
</section>
```

### Step 4: Test the Animations

1. Load the page in a browser
2. Scroll down to see animations trigger
3. Check browser console for any errors
4. Test on mobile devices

## Troubleshooting

### If animations don't work:

1. **Check file paths**: Ensure the animations folder is in the correct location
2. **Check console errors**: Look for 404 errors or JavaScript errors
3. **Verify class names**: Make sure section class names match exactly
4. **Clear cache**: Hard refresh the page (Ctrl+F5)

### For debugging:

Add this class to the `<body>` tag to enable debug mode:

```html
<body class="debug-animations"></body>
```

This will show outlines around animated elements and help identify issues.

## Performance Tips

1. **Test on mobile**: Animations are optimized for mobile but test performance
2. **Monitor loading**: Ensure animations don't slow down page load
3. **Check browser support**: Animations work on all modern browsers with fallbacks

## Customization

To modify animation timing or effects, edit the individual CSS files in the animations folder. Each section has its own file for easy customization.

---

**That's it!** The animations should now work automatically as users scroll through your page.
