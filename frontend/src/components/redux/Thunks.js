import {createAsyncThunk } from "@reduxjs/toolkit";
import ApiRequestHandler from "../../apiUtility/ApiRequestHandler";
import { apiRoutes } from "../../apiUtility/apiRoutes";
const organizedStories = (rawData) => {
    return rawData.reduce((acc, curr) => {
      const { id, day, story, saved,completed } = curr;
      const lowerDay = day.toLowerCase();
  
      if (!acc[lowerDay]) {
        acc[lowerDay] = [];
      }
  
      acc[lowerDay].push({ id: id, value: story, saved: saved, completed:completed });
  
      return acc;
    }, {});
  };
  
  export const fetchStoriesFromBackend = createAsyncThunk(
    "stories/fetchStoriesFromBackend",
    async (userId, thunkAPI) => {
      try {
        const response = await ApiRequestHandler.get(
          apiRoutes.fetchStories.path + "/" + userId.userId
        );
        const organizedData = organizedStories(response.data.data.data); // Organize the data here
        return { data: organizedData }; // Return an object with the organized data
      } catch (error) {
        return thunkAPI.rejectWithValue(error.response.data);
      }
    }
  );
  
  export const saveStoryToBackend = createAsyncThunk(
    "stories/saveStoryToBackend",
    async ({day,story,storyIndex}, thunkAPI) => {
      const user = localStorage.getItem("loginDetail")
        ? JSON.parse(localStorage.getItem("loginDetail"))
        : [];
      try {
        let form_data = new FormData();
        form_data.append('story', story);
  
        form_data.append("day",day);
        form_data.append("saved", "True");
        form_data.append("completed", "False");
        form_data.append("user_id", user.id);
        const response = await ApiRequestHandler.post(
          apiRoutes.addStory.path,
          form_data,
          { "Content-Type": "application/x-www-form-urlencoded" }
        );
        return {data:response.data.data.data,storyIndex};
      } catch (error) {
        return thunkAPI.rejectWithValue(error.response.data);
      }
    }
  );
  
  export const editStoryOnBackend = createAsyncThunk(
    "stories/editStoryOnBackend",
    async ({newValue, storyId }, thunkAPI) => {
      try {
  
        let form_data = new FormData();
        form_data.append("story", newValue);
  
        const response = await ApiRequestHandler.post(
          apiRoutes.editStory.path + "/" + storyId,
          form_data,
          { "Content-Type": "application/x-www-form-urlencoded" }
        );
        return response.data.data;
      } catch (error) {
        return thunkAPI.rejectWithValue(error.response.data);
      }
    }
  );
  export const markCompletedStoryOnBackend = createAsyncThunk(
    "stories/markCompletedStoryOnBackend",
    async ({isCompleted, storyId }, thunkAPI) => {
      try {
        // Construct the request payload with the updated story data
  
        let form_data = new FormData();
        form_data.append("completed", isCompleted);
  
        const response = await ApiRequestHandler.post(
          apiRoutes.editStory.path + "/" + storyId,
          form_data,
          { "Content-Type": "application/x-www-form-urlencoded" }
        );
        return response.data.data;
      } catch (error) {
        return thunkAPI.rejectWithValue(error.response.data);
      }
    }
  );
  
  export const removeStoryFromBackend = createAsyncThunk(
    "stories/removeStoryFromBackend",
    async ({ day, storyIndex, id }, thunkAPI) => {
      try {
  
        const response = await ApiRequestHandler.delete(
          apiRoutes.removeStory.path + "/" + id
        );
        return response.data;
      } catch (error) {
        return thunkAPI.rejectWithValue(error.response.data);
      }
    }
  );
  