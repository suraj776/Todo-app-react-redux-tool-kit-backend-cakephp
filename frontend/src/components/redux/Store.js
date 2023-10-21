import { configureStore } from '@reduxjs/toolkit';
import StorySlice from './StorySlice'; // Adjust the path

const store = configureStore({
  reducer: {
    stories: StorySlice,
  },
});

export default store;