<script setup>
import { ref, onMounted } from 'vue'

const quote = ref(null)
const loading = ref(true)

async function fetchQuote() {
  loading.value = true
  try {
    const response = await fetch('https://get-inspired-h4bqhkffgbg3hjbm.westeurope-01.azurewebsites.net/quotes.php')
    if (!response.ok) throw new Error('Network response was not ok')
    quote.value = await response.json()
  } catch (error) {
    console.error('Error fetching quote:', error)
    quote.value = null
  } finally {
    loading.value = false
  }
}

// Fetch a quote when the component mounts
onMounted(fetchQuote)
</script>

<template>
  <div class="container">

    <!-- Video Background -->
    <video autoplay muted loop class="bg-video">
      <source src="/background.mp4" type="video/mp4" />
    </video>

    <!-- Quote content container -->
    <div class="quote-content">
      <h1>🌟 Daily Quote</h1>

      <!-- Loading state -->
      <div v-if="loading">Loading...</div>

      <!-- Quote display -->
      <div v-else-if="quote">
        <blockquote>"{{ quote.text }}"</blockquote>
        <p>- {{ quote.author }}</p>
      </div>

      <!-- Error fallback -->
      <div v-else>
        <p>Failed to load quote. Try again later.</p>
      </div>

      <!-- Button to fetch a new quote -->
      <button @click="fetchQuote">New Quote</button>
    </div>
  </div>
</template>

<style scoped>
/* Video background */
.bg-video {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  object-fit: cover;
  z-index: -1;
  filter: none; /* removed brightness filter */
}

/* Main container */
.container {
  position: relative;
  min-height: 100vh;
  display: flex;
  justify-content: center;
  align-items: center;
  color: #fff;
  text-align: center;
  padding: 20px;
}


/* Quote content box */
.quote-content {
  position: relative;
  z-index: 1;
  background: rgba(0, 0, 0, 0.3); 
  backdrop-filter: blur(5px); 
  padding: 30px 50px;
  border-radius: 20px;
  max-width: 700px;
}


/* Quote text */
blockquote {
  font-size: 2rem;
  font-weight: 500;
  margin: 20px auto;
  animation: fadeIn 0.6s ease-in-out;
}

/* Button styling */
button {
  padding: 12px 30px;
  font-size: 1rem;
  border: none;
  border-radius: 50px;
  background-color: rgba(255,255,255,0.2);
  color: #fff;
  cursor: pointer;
  transition: 0.3s;
  margin-top: 15px;
}

button:hover {
  background-color: rgba(255,255,255,0.4);
}

/* Fade-in animation */
@keyframes fadeIn {
  from { opacity: 0; transform: translateY(10px); }
  to { opacity: 1; transform: translateY(0); }
}
</style>
