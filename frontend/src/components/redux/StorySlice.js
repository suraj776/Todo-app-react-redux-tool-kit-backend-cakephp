import { createSlice, createAsyncThunk } from "@reduxjs/toolkit";
import { v1 as uuidv1 } from "uuid";
import { apiRoutes } from "../../apiUtility/apiRoutes";
import ApiRequestHandler from "../../apiUtility/ApiRequestHandler";
import { editStoryOnBackend, fetchStoriesFromBackend, markCompletedStoryOnBackend, saveStoryToBackend } from "./Thunks";
const initialState = {
  stories: {
    monday: [],
    tuesday: [],
    wednesday: [],
    thursday: [],
    friday: [],
    saturday: [],
    sunday: [],
  },
  savedStories: [],
};


const storiesSlice = createSlice({
  name: "stories",
  initialState,
  reducers: {
    addStory: (state, action) => {
      const { day, story } = action.payload;
      const id = uuidv1(); // Generate a unique ID for the story
      const lowerDay = day.toLowerCase();

      // Ensure the stories array for the specific day exists, if not, initialize it
      if (!state.stories[lowerDay]) {
        state.stories[lowerDay] = [];
      }

      state.stories[lowerDay].push({ id, value: story, saved: false,completed:false });
    },

    markStoryAsSaved: (state, action) => {
      const { day, storyIndex } = action.payload;
      const lowerDay = day.toLowerCase();

      if (state.stories[lowerDay] && state.stories[lowerDay][storyIndex]) {
        state.stories[lowerDay][storyIndex].saved = true;
      }
    },
    removeStory: (state, action) => {
      const { day, storyIndex } = action.payload;
      const lowerDay = day.toLowerCase();

      // Remove the story from the specified day
      if (state.stories[lowerDay]) {
        state.stories[lowerDay].splice(storyIndex, 1);
      }
    },
    saveEditedStory: (state, action) => {
      const { day, storyId, newValue,index } = action.payload;
      const lowerDay = day.toLowerCase();

      // Update the story value directly in the state
      if (state.stories[lowerDay]) {
        state.stories[lowerDay].splice(index, 1);
      }
      const updatedStories = state.stories[lowerDay].map((story, index) => {
        if (story.id === storyId) {
          return { ...story, value: newValue };
        }
        return story;
      });

      state.stories[lowerDay] = updatedStories;
    },
    updateStoryMenu: (state, action) => {
      const { updatedStories, day } = action.payload;
      const lowerDay = day.toLowerCase();
      // Update the state with the updated stories
      if (updatedStories.length) {
        state.stories[lowerDay] = updatedStories;
      }
    },
  },
  extraReducers: (builder) => {
    builder.addCase(fetchStoriesFromBackend.fulfilled, (state, action) => {
      const { data } = action.payload;
      if (data) {
        Object.keys(data).forEach((day) => {
          const lowerDay = day.toLowerCase();
          if (state.stories[lowerDay]) {
            state.stories[lowerDay].push(...data[day]);
            if (state.stories[lowerDay].length > 1) {
              state.stories[lowerDay] = state.stories[lowerDay].filter(
                (story, i, a) =>
                  a.findIndex((story2) => story2.id === story.id) === i
              );
            }
          }
        });
      }
    });
      builder.addCase(saveStoryToBackend.fulfilled, (state, action) => {
        const {data,storyIndex } = action.payload;
        console.log(data);
        const updatedStories = state.stories[data.day].map((story, index) => {
          if (storyIndex === index) {
             story={ ...story, ...data };
             console.log(story);
             return story;
          }
          return story;
        });
        
        state.stories[data.day] = updatedStories;
      });
      builder.addCase(editStoryOnBackend.fulfilled, (state, action) => {
        const {data} = action.payload;
        const updatedStories = state.stories[data.day].map((story, index) => {
          if (data.id === story.id) {
            return { ...story, value:data.story };
          }
          return story;
        });
  
        state.stories[data.day] = updatedStories;
      });
      builder.addCase(markCompletedStoryOnBackend.fulfilled, (state, action) => {
        const {data} = action.payload;
        const updatedStories = state.stories[data.day].map((story, index) => {
          if (data.id === story.id) {
            return { ...story, completed:data.completed };
          }
          return story;
        });
  
        state.stories[data.day] = updatedStories;
      });
  },
});

export const {
  updateStoryMenu,
  addStory,
  editStory,
  markStoryAsSaved,
  removeStory,
  saveEditedStory,
} = storiesSlice.actions;

export default storiesSlice.reducer;
