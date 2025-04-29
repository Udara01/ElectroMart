<?php
namespace App\Controllers;
use App\Models\UserAccountModel; // Import the UserAccountModel
use CodeIgniter\Controller; // Import the Controller class from CodeIgniter


use CodeIgniter\I18n\Time; // Import Time class for date and time handling

class UserAccount extends BaseController{


    public function create_Account(){
        $userAccountModel = new UserAccountModel(); 


        $password = $this->request->getPost('password'); // Get the password from the request
        $confirm_password = $this->request->getPost('conf_password'); // Get the confirm password from the request

        if($password !== $confirm_password) {
            return redirect()->back()->with('error', 'Passwords do not match!'); // Redirect back with an error message
        }
        else {
            // Hash the password for security
            $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Hash the password using bcrypt
        }
        
        $data = [
            'username' => $this->request->getPost('username'), // Get the username from the request
            'email' => $this->request->getPost('email'), // Get the email from the request
            'password' => $hashed_password, // Use the hashed password
            //'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT), // Hash the password for security
            'created_at' => Time::now() // Get the current date and time
        ];

        $userAccountModel->save($data); // Save the data to the database
        return redirect()->to('/login')->with('success', 'Registration successful!');

    }


    // This function is used to login the user
    // It gets the data from the form and checks it against the database using the UserAccountModel
    public function login_Account(){
        $userAccountModel = new UserAccountModel(); // Create an instance of the UserAccountModel

        $login = $this->request->getPost('login'); // Get the login input (username or email)
        $password = $this->request->getPost('password'); // Get the password input

        // Check if the user exists in the database
        $user = $userAccountModel->where('username', $login)->orWhere('email', $login)->first(); // Find user by username or email

        $hashed_password = $user['password']; // Get the hashed password from the database
        if ($user){
            if (password_verify($password, $hashed_password)) { // Verify the password
                session()->set('logged_in', true); // Set session variable for logged in user
                session()->set('user_id', $user['id']); // Set session variable for user ID
                return redirect()->to('/home')->with('success', 'Login successful!'); // Redirect to home page with success message
            } else {
                return redirect()->back()->with('error', 'Invalid password!'); // Redirect back with error message
            }
        } else {
            return redirect()->back()->with('error', 'User not found!'); // Redirect back with error message
        }
    }

    public function profile()
{
    if (!session()->get('logged_in')) {
        return redirect()->to('/login')->with('error', 'Please login first.');
    }

    $userAccountModel = new UserAccountModel();
    $user = $userAccountModel->find(session()->get('user_id'));

    return view('auth/profile', ['user' => $user, 'title' => 'Your Profile']);
}


public function logout()
{
    session()->destroy(); // Destroys all session data
    return redirect()->to('/login')->with('success', 'Logged out successfully!');
}


}
?>


