/**
 * Simple Scroll-Based Animations for Sortout Innovation Website
 * Uses Intersection Observer API for performance
 */

document.addEventListener("DOMContentLoaded", function () {
  // Check if Intersection Observer is supported
  if ("IntersectionObserver" in window) {
    setupIntersectionObserver();
  } else {
    // Fallback for older browsers
    setupScrollListener();
  }
});

function setupIntersectionObserver() {
  const observerOptions = {
    threshold: 0.2,
    rootMargin: "0px 0px -50px 0px",
  };

  const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        entry.target.classList.add("animate");
        // Unobserve after animation to prevent re-triggering
        observer.unobserve(entry.target);
      }
    });
  }, observerOptions);

  // Sections to animate
  const sections = [
    ".hero-section",
    ".partners-section",
    "#about",
    ".industries-section",
    ".featured-services",
    ".brand-potential-section",
    ".who-we-serve",
    ".our-process",
    ".cta-section",
  ];

  // Observe all sections
  sections.forEach((selector) => {
    const element = document.querySelector(selector);
    if (element) {
      observer.observe(element);
    }
  });
}

function setupScrollListener() {
  // Fallback for browsers without Intersection Observer
  const sections = [
    ".hero-section",
    ".partners-section",
    "#about",
    ".industries-section",
    ".featured-services",
    ".brand-potential-section",
    ".who-we-serve",
    ".our-process",
    ".cta-section",
  ];

  function checkSections() {
    sections.forEach((selector) => {
      const element = document.querySelector(selector);
      if (element && isElementInViewport(element)) {
        element.classList.add("animate");
      }
    });
  }

  function isElementInViewport(el) {
    const rect = el.getBoundingClientRect();
    return (
      rect.top <=
        (window.innerHeight || document.documentElement.clientHeight) * 0.8 &&
      rect.bottom >= 0
    );
  }

  // Check on scroll
  window.addEventListener("scroll", checkSections);

  // Initial check
  checkSections();
}
