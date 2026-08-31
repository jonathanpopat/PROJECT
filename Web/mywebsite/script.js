const quotes = [
  { text: "The unexamined life is not worth living.", author: "Socrates" },
  { text: "He who has a why to live can bear almost any how.", author: "Friedrich Nietzsche" },
  { text: "We suffer more often in imagination than in reality.", author: "Seneca" },
  { text: "Man is condemned to be free.", author: "Jean-Paul Sartre" },
  { text: "The only true wisdom is in knowing you know nothing.", author: "Socrates" },
  { text: "It is not that we have a short time to live, but that we waste a lot of it.", author: "Seneca" },
  { text: "I think, therefore I am.", author: "René Descartes" },
  { text: "Whereof one cannot speak, thereof one must be silent.", author: "Ludwig Wittgenstein" },
  { text: "Hell is other people.", author: "Jean-Paul Sartre" },
  { text: "The obstacle is the way.", author: "Marcus Aurelius" },
  { text: "Nothing is permanent except change.", author: "Heraclitus" },
  { text: "You have power over your mind, not outside events. Realize this, and you will find strength.", author: "Marcus Aurelius" },
  { text: "One cannot step twice in the same river.", author: "Heraclitus" },
  { text: "The life of man is solitary, poor, nasty, brutish, and short.", author: "Thomas Hobbes" },
  { text: "Man is born free, and everywhere he is in chains.", author: "Jean-Jacques Rousseau" },
  { text: "That which does not kill us makes us stronger.", author: "Friedrich Nietzsche" },
  { text: "The mind is everything. What you think you become.", author: "Buddha" },
  { text: "Happiness is not an ideal of reason but of imagination.", author: "Immanuel Kant" },
  { text: "There is nothing either good or bad, but thinking makes it so.", author: "William Shakespeare" },
  { text: "To be is to be perceived.", author: "George Berkeley" },
  { text: "Existence precedes essence.", author: "Jean-Paul Sartre" },
  { text: "Doubt is the origin of wisdom.", author: "René Descartes" },
  { text: "The measure of a man is what he does with power.", author: "Plato" },
  { text: "Waste no more time arguing about what a good man should be. Be one.", author: "Marcus Aurelius" },
  { text: "Freedom is what you do with what's been done to you.", author: "Jean-Paul Sartre" },
  { text: "He who is not everyday conquering some fear has not learned the secret of life.", author: "Ralph Waldo Emerson" },
  { text: "The wound is the place where the light enters you.", author: "Rumi" },
  { text: "Between stimulus and response there is a space. In that space is our power to choose our response.", author: "Viktor Frankl" },
  { text: "What is rational is actual, and what is actual is rational.", author: "G.W.F. Hegel" },
  { text: "The privilege of a lifetime is to become who you truly are.", author: "Carl Jung" }
];

const pick = quotes[Math.floor(Math.random() * quotes.length)];
document.getElementById('quote-text').textContent = pick.text;
document.getElementById('quote-author').textContent = pick.author;
