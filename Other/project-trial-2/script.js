/**
 * Ashworth & Vane — Loan Inquiry Modal
 * -------------------------------------------------------------------------
 * Opens a popup form when any "Apply" element is clicked, pre-fills the
 * loan type, and submits the inquiry to Formspree (works on static hosts
 * like GitHub Pages, since there is no server-side PHP available there).
 *
 * SETUP REQUIRED: replace FORMSPREE_ENDPOINT below with your own form
 * endpoint from https://formspree.io (free tier is fine). See the
 * step-by-step instructions provided alongside this file.
 */

const FORMSPREE_ENDPOINT = "https://formspree.io/f/REPLACE_WITH_YOUR_FORM_ID";

const loanLabels = {
  home: "Home Loan",
  gold: "Gold Loan",
  car: "Car Loan",
  personal: "Personal Loan",
};

const modal        = document.getElementById("loanModal");
const modalTitle    = document.getElementById("modalLoanLabel");
const modalTypeSelect = document.getElementById("modal_loan_type");
const modalCloseBtn = document.getElementById("modalCloseBtn");
const modalDoneBtn  = document.getElementById("modalDoneBtn");
const modalError    = document.getElementById("modalError");
const formView      = document.getElementById("modalFormView");
const successView   = document.getElementById("modalSuccessView");
const successName   = document.getElementById("successName");
const successRef    = document.getElementById("successRef");
const loanForm      = document.getElementById("loanForm");
const submitBtn     = document.getElementById("modalSubmitBtn");

let lastFocusedElement = null;

function openModal(loanType) {
  const type = loanLabels[loanType] ? loanType : "home";

  modalTitle.textContent = loanLabels[type];
  modalTypeSelect.value = type;

  formView.hidden = false;
  successView.hidden = true;
  modalError.hidden = true;
  loanForm.reset();
  modalTypeSelect.value = type;

  lastFocusedElement = document.activeElement;
  modal.classList.add("is-open");
  modal.setAttribute("aria-hidden", "false");
  document.body.style.overflow = "hidden";

  const firstField = document.getElementById("modal_full_name");
  if (firstField) firstField.focus();
}

function closeModal() {
  modal.classList.remove("is-open");
  modal.setAttribute("aria-hidden", "true");
  document.body.style.overflow = "";
  if (lastFocusedElement) lastFocusedElement.focus();
}

// Wire up every "Apply" trigger on the page.
document.querySelectorAll(".js-open-modal").forEach((el) => {
  el.addEventListener("click", () => {
    openModal(el.getAttribute("data-loan-type") || "home");
  });
});

modalCloseBtn.addEventListener("click", closeModal);
modalDoneBtn.addEventListener("click", closeModal);

modal.addEventListener("click", (event) => {
  if (event.target === modal) closeModal();
});

document.addEventListener("keydown", (event) => {
  if (event.key === "Escape" && modal.classList.contains("is-open")) {
    closeModal();
  }
});

function showError(message) {
  modalError.textContent = message;
  modalError.hidden = false;
}

function generateReference() {
  const year = new Date().getFullYear();
  const chunk = Math.random().toString(16).slice(2, 7).toUpperCase();
  return `AV-${year}-${chunk}`;
}

loanForm.addEventListener("submit", async (event) => {
  event.preventDefault();
  modalError.hidden = true;

  const fullName   = document.getElementById("modal_full_name").value.trim();
  const email      = document.getElementById("modal_email").value.trim();
  const phone      = document.getElementById("modal_phone").value.trim();
  const loanAmount = document.getElementById("modal_loan_amount").value.trim();
  const loanType   = modalTypeSelect.value;

  if (fullName.length < 2) {
    showError("Please enter your full name.");
    return;
  }
  if (!/^\S+@\S+\.\S+$/.test(email)) {
    showError("Please enter a valid email address.");
    return;
  }
  if (!/^[0-9+()\s-]{7,20}$/.test(phone)) {
    showError("Please enter a valid phone number.");
    return;
  }
  if (!loanAmount || Number(loanAmount) < 500) {
    showError("Loan amount must be at least £500.");
    return;
  }

  submitBtn.disabled = true;
  submitBtn.textContent = "Submitting…";

  try {
    const response = await fetch(FORMSPREE_ENDPOINT, {
      method: "POST",
      headers: { Accept: "application/json" },
      body: new FormData(loanForm),
    });

    if (!response.ok) {
      throw new Error("Submission failed");
    }

    formView.hidden = true;
    successView.hidden = false;
    successName.textContent = fullName.split(" ")[0];
    successRef.textContent = `Reference Number: ${generateReference()}`;
  } catch (err) {
    showError(
      "We couldn't submit your enquiry. Please check the site's form setup, or call us directly at +44 20 7946 0891."
    );
  } finally {
    submitBtn.disabled = false;
    submitBtn.textContent = "Submit Inquiry";
  }
});
