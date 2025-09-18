// Firebase Configuration
const firebaseConfig = {
    apiKey: "AIzaSyBIGOJfeLPbgFAOQFlTUNw5HRPZS0svk_c",
    authDomain: "curimbadomestre.firebaseapp.com",
    projectId: "curimbadomestre",
    storageBucket: "curimbadomestre.firebasestorage.app",
    messagingSenderId: "819717678120",
    appId: "1:819717678120:web:f39c49f368bcc52f96411d",
    measurementId: "G-JQRTQZ6MQL"
};

// Initialize Firebase
firebase.initializeApp(firebaseConfig);

// Firebase Auth instance
const auth = firebase.auth();

// Firebase Auth State Observer
auth.onAuthStateChanged(function(user) {
    if (user) {
        console.log('Usuário logado:', user);
        // Usuário está logado
        handleUserLogin(user);
    } else {
        console.log('Usuário deslogado');
        // Usuário está deslogado
        handleUserLogout();
    }
});

// Função para fazer login com Google
function signInWithGoogle() {
    const provider = new firebase.auth.GoogleAuthProvider();
    auth.signInWithPopup(provider)
        .then((result) => {
            console.log('Login com Google realizado com sucesso');
        })
        .catch((error) => {
            console.error('Erro no login com Google:', error);
        });
}

// Função para fazer login com email/senha
function signInWithEmail(email, password) {
    auth.signInWithEmailAndPassword(email, password)
        .then((result) => {
            console.log('Login com email realizado com sucesso');
        })
        .catch((error) => {
            console.error('Erro no login com email:', error);
        });
}

// Função para criar conta com email/senha
function createUserWithEmail(email, password) {
    auth.createUserWithEmailAndPassword(email, password)
        .then((result) => {
            console.log('Conta criada com sucesso');
        })
        .catch((error) => {
            console.error('Erro ao criar conta:', error);
        });
}

// Função para fazer logout
function signOut() {
    auth.signOut()
        .then(() => {
            console.log('Logout realizado com sucesso');
        })
        .catch((error) => {
            console.error('Erro no logout:', error);
        });
}

// Função para lidar com login do usuário
function handleUserLogin(user) {
    // Obtém o token ID
    user.getIdToken()
        .then((idToken) => {
            // Envia o token para o Laravel
            sendTokenToLaravel(idToken);
        })
        .catch((error) => {
            console.error('Erro ao obter token:', error);
        });
}

// Função para enviar token para o Laravel
function sendTokenToLaravel(idToken) {
    fetch('/firebase/login', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            id_token: idToken
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.token) {
            // Salva o token do Laravel
            localStorage.setItem('laravel_token', data.token);
            localStorage.setItem('firebase_uid', data.firebase_uid);
            
            // Redireciona baseado no role do usuário
            if (data.user.role === 'admin') {
                window.location.href = '/admin/dashboard';
            } else {
                window.location.href = '/student/dashboard';
            }
        } else if (data.user) {
            // Já autenticado via sessão, redireciona mesmo sem token
            if (data.user.role === 'admin') {
                window.location.href = '/admin/dashboard';
            } else {
                window.location.href = '/student/dashboard';
            }
        }
    })
    .catch(error => {
        console.error('Erro ao enviar token para Laravel:', error);
    });
}

// Função para lidar com logout do usuário
function handleUserLogout() {
    // Remove tokens do localStorage
    localStorage.removeItem('laravel_token');
    localStorage.removeItem('firebase_uid');
    
    // Redireciona para a página inicial
    window.location.href = '/';
}

// Função para verificar se o usuário está logado
function isUserLoggedIn() {
    return auth.currentUser !== null;
}

// Função para obter o usuário atual
function getCurrentUser() {
    return auth.currentUser;
}

// Exporta as funções para uso global
window.FirebaseAuth = {
    signInWithGoogle,
    signInWithEmail,
    createUserWithEmail,
    signOut,
    isUserLoggedIn,
    getCurrentUser
};

