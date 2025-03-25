// cunyc-jp-script.js

function toggleContent(contentId) {
  const content = document.getElementById(contentId);
  // console.log("contentId: ", contentId);  // Debugging: Log the content ID to the console

  // Check if the content exists
  if (!content) {
    console.error('Invalid content ID');
    return;
  }

  // Check if the content section is currently active
  const isActive = content.classList.contains('active');

  // Close all other open content sections
  const contents = document.querySelectorAll('.lag-jp-panel');
  contents.forEach(otherContent => {
    if (otherContent.id !== contentId) {
      otherContent.classList.remove('active');
    }
  });

  // Toggle the active class to collapse or expand the content
  content.classList.toggle('active', !isActive);
}
