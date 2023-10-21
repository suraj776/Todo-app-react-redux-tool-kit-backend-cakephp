import React, { useRef, useEffect } from "react";
import { useDispatch, useSelector } from "react-redux";
import {
  addStory,
  markStoryAsSaved,
  removeStory,
  saveEditedStory,
  updateStoryMenu,
} from "../redux/StorySlice";
import "./style.css";
import { useNavigate } from "react-router-dom";
import { toast } from "react-toastify";
import { editStoryOnBackend, markCompletedStoryOnBackend, removeStoryFromBackend, saveStoryToBackend } from "../redux/Thunks";

const StoryCard = (props) => {
  const containerRef = useRef(null);
  const dispatch = useDispatch();
  const navigate = useNavigate();
  const stories = useSelector(
    (state) => state.stories.stories[props.day.toLowerCase()]
  );
  const d = new Date();
  let day = d.getDay();

  // useEffect(() => {}, [dispatch]);

  const createForm = (handleSubmit, day, inputValue = "") => {
    const form = document.createElement("form");
    form.className = "add-story-form";
    const formGroup = document.createElement("div");
    formGroup.className = "form-group mt-3 p-3 d-flex";

    const input = document.createElement("input");
    input.className = "form-control mr-2";
    input.type = "text";
    input.name = "value";
    input.value = inputValue;

    const button = document.createElement("button");
    button.className = "btn icon-button";
    button.type = "submit";
    button.innerHTML = '<i class="fa fa-plus" aria-hidden="true"></i>';

    formGroup.appendChild(input);
    formGroup.appendChild(button);
    form.appendChild(formGroup);
    form.addEventListener("submit", (event) => handleSubmit(event, day));

    // Append the form to a specific element in the DOM
    if (containerRef.current) {
      containerRef.current.appendChild(form);
    }
  };

  const editForm = (
    handleSubmit,
    day,
    parentNode,
    storyId,
    index,
    inputValue = ""
  ) => {
    const form = document.createElement("form");
    form.className = "add-story-form";
    const formGroup = document.createElement("div");
    formGroup.className = "form-group mt-3 p-3 d-flex";

    const input = document.createElement("input");
    input.className = "form-control mr-2";
    input.type = "text";
    input.name = "value";
    input.value = inputValue;

    const button = document.createElement("button");
    button.className = "btn icon-button";
    button.type = "submit";
    button.innerHTML = '<i class="fa fa-plus" aria-hidden="true"></i>';

    formGroup.appendChild(input);
    formGroup.appendChild(button);
    form.appendChild(formGroup);
    form.addEventListener("submit", (event) =>
      handleSubmit(event, day, storyId, index, parentNode)
    );
    if (parentNode) {
      parentNode.insertAdjacentElement("afterend", form);
    }
  };

  const toggleMenu = (storyIndex = 0) => {
    const updatedStories = stories.map((story, index) => {
      if (story.isMenuOpen && index !== storyIndex) {
        return { ...story, isMenuOpen: false };
      }
      if (storyIndex) {
        if (story.id === storyIndex) {
          return { ...story, isMenuOpen: !story.isMenuOpen };
        }
      } else {
        if (story.isMenuOpen) {
          return { ...story, isMenuOpen: !story.isMenuOpen };
        }
      }

      return story;
    });
    dispatch(updateStoryMenu({ updatedStories, day: props.day }));
  };
  const handleformData = (event, day) => {
    event.preventDefault();
    const formData = new FormData(event.target);
    const story = formData.get("value");
    event.target.reset();
    if (containerRef.current) {
      containerRef.current.removeChild(event.target);
    }
    dispatch(addStory({ day, story }));
  };
  const handleAddStory = (day) => {
    createForm(handleformData, day);
    toggleMenu();
  };

  const handleSaveStory = (storyIndex, story, day, storyId) => {
    if (!localStorage.getItem("token")) {
      let confirm = window.confirm(
        "you need to login to save, confirm to go to login page."
      );
      if (confirm) {
        navigate("/signin");
      } else {
        toggleMenu(storyId);
      }
      return 0;
    }
    day = day.toLowerCase();

    dispatch(saveStoryToBackend({ day, story, storyIndex }));
    dispatch(markStoryAsSaved({ day, storyIndex }));
    toggleMenu();

    toast.success("Story is added");
  };
  const handleEditedData = (event, day, storyId, index, parentNode) => {
    event.preventDefault();
    const formData = new FormData(event.target);
    const newValue = formData.get("value");
    event.target.reset();

    // Remove the form
    const formToRemove = parentNode.nextElementSibling;
    if (formToRemove) {
      formToRemove.remove();
    }
    // parentNode.innerHTML = '';
    dispatch(editStoryOnBackend({ newValue, storyId }));
    dispatch(saveEditedStory({ day: day, storyId: storyId, newValue, index }));
    toggleMenu(storyId);
    toggleMenu(storyId);
    toast.success("Story is updated");
  };

  const handleEditStory = (storyId, day, event, index) => {
    let story = stories.find((story) => story.id === storyId);
    let value = story.value;
    const parentContainer = event.target.closest(".list-group-item");
    toggleMenu(storyId);
    editForm(handleEditedData, day, parentContainer, storyId, index, value);
  };
  const handleCompleted = (event, storyId) => {
    let isCompleted = "";
    if (event.target.checked) {
      isCompleted = "True";
    }
    const updatedStories = stories.map((story) =>
    story.id === storyId ? { ...story, completed: event.target.checked ? true : false } : story
  );
  // Dispatch the action to update the store with the updatedStories
   dispatch(updateStoryMenu({ updatedStories, day: props.day }));
    dispatch(markCompletedStoryOnBackend({ isCompleted, storyId }));
  };
  const handleDeleteStory = (storyIndex, id) => {
    let confirm = window.confirm("Story will be deleted permanently");
    if (confirm) {
      dispatch(removeStoryFromBackend({ day: props.day, storyIndex, id }));
      dispatch(removeStory({ day: props.day, storyIndex }));
      toast.success("Story is removed");
    }
  };

  return (
    <>
      <div
        className={
          day - 1 == props.Dataindex
            ? "card schedule-card schedule-card-active"
            : "card schedule-card"
        }
      >
        <div className="card-header schedule-header">
          <p className="schedule-heading">{props.day}</p>
          <button
            className="btn icon-button"
            onClick={() => handleAddStory(props.day)}
          >
            <i className="fa fa-plus" aria-hidden="true"></i>
          </button>
        </div>
        <ul className="list-group list-group-flush" key={props.index}>
          {stories &&
            stories.length > 0 &&
            stories.map((story, index) => {
              return (
                <li className="list-group-item" key={story.id}>
                  <div className="schedule-item">
                    <div className="schedule-ietm-box">
                      {story.completed ==true ? (
                        <input
                          type="checkbox"
                          name="is_completed1"
                          onChange={(e) => handleCompleted(e, story.id)}
                          checked
                        />
                      ) : (
                        <input
                          type="checkbox"
                          name="is_completed2"
                          onChange={(e) => handleCompleted(e, story.id)}
                        />
                      )}
                      <p className={story.completed?"ml-2 strike-story":"ml-2"}>{story.value}</p>
                    </div>
                    <span>
                      <button
                        className="btn"
                        onClick={() => toggleMenu(story.id)}
                      >
                        <i className="fa fa-ellipsis-v" aria-hidden="true"></i>
                      </button>
                      {story.isMenuOpen && (
                        <div className="menu">
                          {story.saved ? (
                            <>
                              <button
                                className="btn form-button"
                                onClick={(event) =>
                                  handleEditStory(
                                    story.id,
                                    props.day,
                                    event,
                                    index
                                  )
                                }
                              >
                                Edit
                              </button>
                              <button
                                className="btn form-button"
                                onClick={() =>
                                  handleDeleteStory(index, story.id)
                                }
                              >
                                Delete
                              </button>
                            </>
                          ) : (
                            <button
                              className="btn form-button"
                              onClick={() =>
                                handleSaveStory(
                                  index,
                                  story.value,
                                  props.day,
                                  story.id
                                )
                              }
                            >
                              Save
                            </button>
                          )}
                        </div>
                      )}
                    </span>
                  </div>
                </li>
              );
            })}
          <div className="form-container" ref={containerRef}></div>
        </ul>
      </div>
    </>
  );
};

export default StoryCard;
