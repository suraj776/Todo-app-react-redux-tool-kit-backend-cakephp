const API_BASE_URL = 'http://localhost:4001/api/'
export const apiRoutes={
    login:{
        path:API_BASE_URL+'login'
    },
    signup:{
        path:API_BASE_URL+'signup'
    },
    addStory:{
        path:API_BASE_URL+'todo/add'
    },
    fetchStories:{
        path:API_BASE_URL+'todo',
    },
    removeStory:{
        path:API_BASE_URL+'todo/delete',
    },
    editStory:{
        path:API_BASE_URL+'todo/edit',
    }
}
