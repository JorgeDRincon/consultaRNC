<template>
  <div class="api-documentation-content max-w-4xl mx-auto">
    <h1 class="text-4xl font-extrabold text-gray-900 mb-4">API Documentation</h1>
    <p class="text-lg text-gray-600 mb-8">
      Use the Protocol API to access contacts, conversations, group messages, and more and seamlessly integrate your
      product into the workflows of dozens of devoted Protocol users.
    </p>

    <div class="flex space-x-4 mb-12">
      <button class="px-6 py-3 bg-gray-800 text-white rounded-lg font-medium hover:bg-gray-700 transition">
        Quickstart
        <svg class="inline-block ml-2 w-4 h-4 transform -rotate-45" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
      </button>
      <button class="px-6 py-3 bg-white text-gray-800 border border-gray-300 rounded-lg font-medium hover:bg-gray-50 transition">
        Explore SDKs
      </button>
    </div>

    <section class="mb-12">
      <h2 class="text-2xl font-bold text-gray-800 mb-4">Getting started</h2>
      <p class="text-gray-700 leading-relaxed mb-4">
        To get started, create a new application on the dashboard in your <a href="#" class="text-blue-600 hover:underline">developer settings</a>,
        then read about how to make requests for the resources you need to access using our HTTP APIs or dedicated client SDKs.
        When your integration is ready to go live, publish it to our <a href="#" class="text-blue-600 hover:underline">integrations directory</a>
        to reach the Protocol community.
      </p>
      <a href="#" class="text-blue-600 hover:underline font-medium flex items-center">
        Get your API key
        <svg class="ml-1 w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
      </a>
    </section>

    <section class="mb-12">
      <h2 class="text-2xl font-bold text-gray-800 mb-4">Guides</h2>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <CardComponent title="Authentication" description="Learn how to authenticate your API requests." link="/quickstart/authentication" />
        <CardComponent title="Pagination" description="Understand how to work with paginated responses." link="/quickstart/pagination" />
        <CardComponent title="Errors" description="Read about the different types of errors returned by the API." link="/quickstart/errors" />
        <CardComponent title="Webhooks" description="Learn how to programmatically configure webhooks for your app." link="/quickstart/webhooks" />
      </div>
    </section>

    <section class="mb-12">
      <h2 class="text-2xl font-bold text-gray-800 mb-4">Resources</h2>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <CardComponent title="Community Forum" description="Join our developer community to ask questions and share knowledge." link="https://forum.example.com" />
        <CardComponent title="SDKs & Libraries" description="Explore official and community-contributed SDKs for various languages." link="/quickstart/sdks" />
        <CardComponent title="Release Notes" description="Stay updated with the latest features, improvements, and bug fixes." link="/resources/releases" />
        </div>
    </section>
  </div>
</template>

<script>
import CardComponent from '../components/CardComponent.vue';

export default {
  name: 'APIDocumentationPage',
  components: { CardComponent },
};
</script>