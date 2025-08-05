# Scroll-Based Animations for Sortout Innovation Website

This folder contains comprehensive scroll-based animations for the Sortout Innovation website. The animations are designed to enhance user experience by providing smooth, engaging transitions as users scroll through the page.

## 📁 File Structure

```
animations/
├── README.md                           # This documentation file
├── main-animations.css                 # Main CSS file that imports all animations
├── scroll-animations.js                # JavaScript controller for animations
├── hero-section-animations.css         # Hero section animations
├── partners-section-animations.css     # Partners section animations
├── about-section-animations.css        # About section animations
├── industries-section-animations.css   # Industries section animations
├── services-section-animations.css     # Services section animations
├── brand-potential-section-animations.css # Brand potential section animations
├── who-we-serve-section-animations.css # Who we serve section animations
├── process-section-animations.css      # Process section animations
└── cta-section-animations.css          # CTA section animations
```

## 🚀 Quick Start

### 1. Include the CSS file in your HTML

Add this line to your HTML `<head>` section:

```html
<link rel="stylesheet" href="/animations/main-animations.css" />
```

### 2. Include the JavaScript file

Add this line before the closing `</body>` tag:

```html
<script src="/animations/scroll-animations.js"></script>
```

### 3. Ensure your sections have the correct class names

Make sure your HTML sections have the following class names:

- Hero section: `hero-section`
- Partners section: `partners-section`
- About section: `#about` (ID)
- Industries section: `industries-section`
- Services section: `featured-services`
- Brand potential section: `brand-potential-section`
- Who we serve section: `who-we-serve`
- Process section: `our-process`
- CTA section: `cta-section`

## 🎯 Animation Features

### Hero Section

- **Fade-in animations** for content and image
- **Staggered button reveals** with delays
- **Enhanced floating animation** for hero image
- **Text reveal effects** for titles

### Partners Section

- **Staggered logo reveals** with individual delays
- **Enhanced scrolling animation** for logo carousel
- **Hover effects** with grayscale to color transition
- **Title underline animation**

### About Section

- **Split content animations** (image left, content right)
- **Staggered stat card reveals**
- **Number counter animations**
- **Enhanced hover effects**

### Industries Section

- **Circular box animations** with rotation
- **Staggered reveals** for industry boxes
- **Icon and title animations** within boxes
- **Enhanced hover scaling**

### Services Section

- **3D card animations** with rotateX effects
- **Staggered service card reveals**
- **Icon and content animations**
- **View more button animation**

### Brand Potential Section

- **Floating card animations** with gentle movement
- **Glowing core pulse effects**
- **Staggered card reveals**
- **Enhanced hover effects**

### Who We Serve Section

- **Split background animations**
- **Service category reveals**
- **Icon and content animations**
- **Background gradient transitions**

### Process Section

- **Timeline animations** with connecting line
- **Staggered process step reveals**
- **Icon bounce effects**
- **Timeline pulse effects**

### CTA Section

- **Gradient background animations**
- **Button reveal animations**
- **Abstract shape animations**
- **Text glow effects**

## ⚙️ Configuration Options

### Animation Timing

You can adjust animation timing by modifying the CSS custom properties:

```css
:root {
  --animation-duration: 0.8s;
  --animation-delay: 0.2s;
  --stagger-delay: 0.1s;
}
```

### Performance Settings

The JavaScript includes performance optimizations:

```javascript
const observerOptions = {
  threshold: 0.2, // Trigger when 20% of element is visible
  rootMargin: "0px 0px -50px 0px", // Trigger 50px before element enters viewport
};
```

### Responsive Behavior

Animations automatically adjust for different screen sizes:

- **Desktop**: Full animations with all effects
- **Tablet**: Reduced animation intensity
- **Mobile**: Simplified animations for better performance
- **Small screens**: Disabled complex animations

## 🛠️ Customization

### Adding New Animations

1. Create a new CSS file for your section
2. Follow the naming convention: `section-name-animations.css`
3. Add the import to `main-animations.css`
4. Add the section selector to the JavaScript array

### Modifying Existing Animations

Each animation file is self-contained and can be modified independently. Common modifications:

```css
/* Change animation duration */
.your-element {
  transition: all 1.2s ease-out; /* Increased from 0.8s */
}

/* Change animation delay */
.your-element {
  transition-delay: 0.5s; /* Increased from 0.2s */
}

/* Change animation effect */
.your-element {
  transform: translateY(60px) scale(0.8); /* Different initial state */
}
```

## 🎨 Animation Classes

### Utility Classes

The main CSS file includes utility classes for common animations:

```css
/* Delays */
.delay-100 {
  transition-delay: 0.1s;
}
.delay-200 {
  transition-delay: 0.2s;
}
/* ... up to delay-1000 */

/* Durations */
.duration-300 {
  transition-duration: 0.3s;
}
.duration-500 {
  transition-duration: 0.5s;
}
/* ... up to duration-1000 */

/* Timing functions */
.ease-out {
  transition-timing-function: cubic-bezier(0, 0, 0.2, 1);
}
.ease-in-out {
  transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
}
```

## 🔧 JavaScript API

The animation system provides a JavaScript API for advanced control:

```javascript
// Access the animation controller
const animations = window.scrollAnimations;

// Manually trigger an animation
animations.triggerAnimation(".hero-section");

// Reset all animations
animations.resetAnimations();

// Check if animations are active
if (window.scrollAnimations) {
  console.log("Animations are loaded");
}
```

## 🚨 Browser Support

- **Modern browsers**: Full support with Intersection Observer API
- **Older browsers**: Fallback to scroll event listeners
- **Mobile browsers**: Optimized performance with reduced animations

### Fallback Behavior

For browsers without Intersection Observer support:

- Uses scroll event listeners
- Reduced performance but functional
- Graceful degradation

## ♿ Accessibility

The animations respect user preferences:

```css
/* Respect reduced motion preferences */
@media (prefers-reduced-motion: reduce) {
  * {
    animation-duration: 0.01ms !important;
    transition-duration: 0.01ms !important;
  }
}
```

## 🐛 Debugging

Enable debug mode by adding the `debug-animations` class to the body:

```html
<body class="debug-animations"></body>
```

This will:

- Show outlines around animated elements
- Display animation labels
- Show performance monitoring

## 📱 Performance Considerations

- **GPU acceleration**: Uses `transform` and `opacity` for smooth animations
- **Will-change**: Automatically applied to animated elements
- **Throttling**: Scroll events are throttled for performance
- **Mobile optimization**: Reduced animations on smaller screens

## 🔄 Updates and Maintenance

To update animations:

1. Modify the specific section CSS file
2. Test on different devices and browsers
3. Update this README if adding new features
4. Consider performance impact of changes

## 📞 Support

For issues or questions:

1. Check browser console for errors
2. Verify section class names match
3. Ensure CSS and JS files are properly loaded
4. Test with debug mode enabled

---

**Created for Sortout Innovation Website**  
**Version**: 1.0  
**Last Updated**: 2025-01-05
