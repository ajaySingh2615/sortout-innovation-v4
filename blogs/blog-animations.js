// Blog Scroll Animations JavaScript

class BlogScrollAnimations {
  constructor() {
    this.animatedElements = [];
    this.observer = null;
    this.init();
  }

  init() {
    // Wait for DOM to be ready
    if (document.readyState === "loading") {
      document.addEventListener("DOMContentLoaded", () =>
        this.setupAnimations()
      );
    } else {
      this.setupAnimations();
    }
  }

  setupAnimations() {
    this.setupIntersectionObserver();
    this.setupStaggeredAnimations();
    this.setupScrollTriggers();
    this.setupPerformanceOptimizations();
  }

  setupIntersectionObserver() {
    // Create intersection observer for scroll animations
    this.observer = new IntersectionObserver(
      (entries) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            this.animateElement(entry.target);
          }
        });
      },
      {
        threshold: 0.1,
        rootMargin: "0px 0px -50px 0px",
      }
    );

    // Observe all elements with animation classes
    const animatedElements = document.querySelectorAll(`
            .animate-on-scroll,
            .blog-card-animate,
            .blog-title-animate,
            .blog-subtitle-animate,
            .blog-image-animate,
            .blog-content-animate,
            .sidebar-animate,
            .pagination-animate,
            .breadcrumb-animate,
            .social-share-animate,
            .category-tag-animate,
            .popular-item-animate
        `);

    animatedElements.forEach((element) => {
      this.observer.observe(element);
    });
  }

  setupStaggeredAnimations() {
    // Setup staggered animations for blog cards
    const blogCards = document.querySelectorAll(".ezy__blog7_uzmYkEn6-post");
    blogCards.forEach((card, index) => {
      card.classList.add("blog-card-animate");
      card.style.animationDelay = `${index * 0.1}s`;
    });

    // Setup staggered animations for category tags
    const categoryTags = document.querySelectorAll(".blog-category-tag");
    categoryTags.forEach((tag, index) => {
      tag.classList.add("category-tag-animate");
      tag.style.animationDelay = `${index * 0.1}s`;
    });

    // Setup staggered animations for popular blog items
    const popularItems = document.querySelectorAll(
      ".ezy__blogdetails2_f7S9fPCj-item"
    );
    popularItems.forEach((item, index) => {
      item.classList.add("popular-item-animate");
      item.style.animationDelay = `${index * 0.15}s`;
    });
  }

  setupScrollTriggers() {
    // Add scroll-triggered animations for specific elements
    const scrollElements = [
      { selector: ".ezy__blog7_uzmYkEn6-heading", class: "blog-title-animate" },
      {
        selector: ".ezy__blog7_uzmYkEn6-sub-heading",
        class: "blog-subtitle-animate",
      },
      { selector: ".breadcrumb-section", class: "breadcrumb-animate" },
      {
        selector: ".ezy__blogdetails2_f7S9fPCj-social",
        class: "social-share-animate",
      },
      { selector: ".pagination", class: "pagination-animate" },
      {
        selector: ".ezy__blogdetails2_f7S9fPCj-posts",
        class: "sidebar-animate",
      },
    ];

    scrollElements.forEach(({ selector, class: className }) => {
      const element = document.querySelector(selector);
      if (element) {
        element.classList.add(className);
      }
    });

    // Add image animations
    const blogImages = document.querySelectorAll(
      ".ezy-blog7-banner, .blog-main-image"
    );
    blogImages.forEach((image) => {
      image.classList.add("blog-image-animate");
    });

    // Add content animations
    const blogContent = document.querySelector(
      ".ezy__blogdetails2_f7S9fPCj-content"
    );
    if (blogContent) {
      blogContent.classList.add("blog-content-animate");
    }
  }

  animateElement(element) {
    // Add animated class to trigger CSS animations
    element.classList.add("animated");

    // Add specific animation classes based on element type
    if (element.classList.contains("blog-card-animate")) {
      element.style.animation = "fadeInUp 1.2s ease-out forwards";
    } else if (element.classList.contains("blog-title-animate")) {
      element.style.animation = "fadeInLeft 1.2s ease-out forwards";
    } else if (element.classList.contains("blog-subtitle-animate")) {
      element.style.animation = "fadeInRight 1.2s ease-out forwards";
    } else if (element.classList.contains("blog-image-animate")) {
      element.style.animation = "fadeInScale 1.2s ease-out forwards";
    } else if (element.classList.contains("category-tag-animate")) {
      element.style.animation = "bounceIn 1s ease-out forwards";
    } else if (element.classList.contains("popular-item-animate")) {
      element.style.animation = "slideInFromBottom 1s ease-out forwards";
    } else if (element.classList.contains("sidebar-animate")) {
      element.style.animation = "fadeInRight 1.2s ease-out forwards";
    } else if (element.classList.contains("pagination-animate")) {
      element.style.animation = "slideInFromBottom 1s ease-out forwards";
    } else if (element.classList.contains("breadcrumb-animate")) {
      element.style.animation = "slideInFromTop 0.8s ease-out forwards";
    } else if (element.classList.contains("social-share-animate")) {
      element.style.animation = "fadeInScale 0.8s ease-out forwards";
    }

    // Stop observing after animation
    this.observer.unobserve(element);
  }

  setupPerformanceOptimizations() {
    // Check for reduced motion preference
    if (window.matchMedia("(prefers-reduced-motion: reduce)").matches) {
      this.disableAnimations();
    }

    // Optimize for mobile devices
    if (window.innerWidth <= 768) {
      this.optimizeForMobile();
    }

    // Handle window resize
    window.addEventListener("resize", () => {
      if (window.innerWidth <= 768) {
        this.optimizeForMobile();
      } else {
        this.restoreAnimations();
      }
    });
  }

  disableAnimations() {
    const animatedElements = document.querySelectorAll(`
            .animate-on-scroll,
            .blog-card-animate,
            .blog-title-animate,
            .blog-subtitle-animate,
            .blog-image-animate,
            .blog-content-animate,
            .sidebar-animate,
            .pagination-animate,
            .breadcrumb-animate,
            .social-share-animate,
            .category-tag-animate,
            .popular-item-animate
        `);

    animatedElements.forEach((element) => {
      element.style.animation = "none";
      element.style.transition = "none";
      element.style.opacity = "1";
      element.style.transform = "none";
    });
  }

  optimizeForMobile() {
    // Reduce animation complexity on mobile
    const mobileElements = document.querySelectorAll(
      ".blog-card-animate, .popular-item-animate"
    );
    mobileElements.forEach((element) => {
      element.style.animationDuration = "0.8s";
    });
  }

  restoreAnimations() {
    // Restore animations when switching back to desktop
    const mobileElements = document.querySelectorAll(
      ".blog-card-animate, .popular-item-animate"
    );
    mobileElements.forEach((element) => {
      element.style.animationDuration = "";
    });
  }

  // Public method to manually trigger animations
  triggerAnimation(selector, animationClass = "fade-in-up") {
    const element = document.querySelector(selector);
    if (element) {
      element.classList.add(animationClass);
      element.classList.add("animated");
    }
  }

  // Public method to reset animations
  resetAnimations() {
    const animatedElements = document.querySelectorAll(".animated");
    animatedElements.forEach((element) => {
      element.classList.remove("animated");
      element.style.animation = "";
    });

    // Re-observe elements
    this.setupIntersectionObserver();
  }
}

// Initialize animations when script loads
const blogAnimations = new BlogScrollAnimations();

// Export for global access
window.blogAnimations = blogAnimations;

// Additional utility functions
window.BlogAnimationUtils = {
  // Smooth scroll to element with animation
  scrollToElement: (selector, offset = 100) => {
    const element = document.querySelector(selector);
    if (element) {
      const elementPosition = element.offsetTop - offset;
      window.scrollTo({
        top: elementPosition,
        behavior: "smooth",
      });
    }
  },

  // Animate page load
  animatePageLoad: () => {
    document.body.style.opacity = "0";
    document.body.style.transition = "opacity 0.8s ease-in";

    setTimeout(() => {
      document.body.style.opacity = "1";
    }, 100);
  },

  // Animate elements on hover
  setupHoverAnimations: () => {
    const hoverElements = document.querySelectorAll(
      ".ezy__blog7_uzmYkEn6-post, .ezy__blogdetails2_f7S9fPCj-item"
    );

    hoverElements.forEach((element) => {
      element.addEventListener("mouseenter", () => {
        element.style.transform = "translateY(-5px) scale(1.02)";
        element.style.transition = "transform 0.5s ease";
      });

      element.addEventListener("mouseleave", () => {
        element.style.transform = "translateY(0) scale(1)";
      });
    });
  },
};

// Initialize additional features
document.addEventListener("DOMContentLoaded", () => {
  // Animate page load
  BlogAnimationUtils.animatePageLoad();

  // Setup hover animations
  BlogAnimationUtils.setupHoverAnimations();

  // Add loading animation for images
  const images = document.querySelectorAll("img");
  images.forEach((img) => {
    img.addEventListener("load", () => {
      img.classList.add("image-loaded");
    });
  });
});
