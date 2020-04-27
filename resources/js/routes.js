import  Home from './pages/Home';
import  Register_Student from './pages/Register/Register_Student';
import  Register_Company from './pages/Register/Register_Company';
import ConfirmCompany from "./pages/Confirm/ConfirmCompany";
import ConfirmStudent from "./pages/Confirm/ConfirmStudent";
import Register_Mentor from "./pages/Register/Register_Mentor";
import  Login from './pages/Login';


export default [
    {
        path: '/home',
        component: Home,
        name: 'home'
    },
    {
        path: '/register_student',
        component: Register_Student,
        name: 'register_student'
    },
    {
        path: '/register_company',
        component: Register_Company,
        name: 'register_company'
    },
    {
        path: '/register_mentor',
        component: Register_Mentor,
        name: 'register_mentor'
    },
    {
        path: '/login',
        component: Login,
        name: 'login'
    },
    {
        path: '/confirm_company',
        component: ConfirmCompany,
        name: 'confirm_company'
    },
    {
        path: '/confirm_student',
        component: ConfirmStudent,
        name: 'confirm_Student'
    },
]
