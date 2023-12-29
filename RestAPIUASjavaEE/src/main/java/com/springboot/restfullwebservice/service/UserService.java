package com.springboot.restfullwebservice.service;

import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;
import org.springframework.security.crypto.bcrypt.BCryptPasswordEncoder;

import com.springboot.restfullwebservice.Enitity.Surat;
import com.springboot.restfullwebservice.Enitity.User;
import com.springboot.restfullwebservice.repository.UserRepository;

@Service
public class UserService {
    @Autowired
    private UserRepository userRepository;

    @Autowired
    private BCryptPasswordEncoder bCryptPasswordEncoder;

    public User registerUser(User user) {
        // Enkripsi password sebelum menyimpannya
    	  if (userRepository.existsByUsername(user.getUsername())) {
    	        throw new RuntimeException("Username sudah digunakan. Pilih username lain.");
    	    }
        String encodedPassword = bCryptPasswordEncoder.encode(user.getPassword());
        user.setPassword(encodedPassword);
        user.setRoles("Mahasiswa");
        return userRepository.save(user);
    }
    public List<User> getAllUsers() {
        return userRepository.findAll();
    }
    
    public User findUserByUsername(String username) {
        return userRepository.findByUsername(username);
    }
    public User getUserById(Long id) {
        return userRepository.findById(id).orElse(null);
    }


    public User loginUser(String username, String password) {
        User user = userRepository.findByUsername(username);
        if (user != null && bCryptPasswordEncoder.matches(password, user.getPassword())) {
            return user;
        }
        return null;
    }
    
    public void deleteUserById(Long id) {
        userRepository.deleteById(id);
    }

    public User updateUser(Long id, User updatedUser) {
        User existingUser = userRepository.findById(id).orElse(null);

        if (existingUser != null) {
        		existingUser.setNama_Lengkap(updatedUser.getNama_Lengkap());
        		existingUser.setNomor_Handphone(updatedUser.getNomor_Handphone());
        		existingUser.setNIM(updatedUser.getNIM());
        		existingUser.setNomor_KTP(updatedUser.getNomor_KTP());
                return userRepository.save(existingUser);
            } 
        else {
            return null;
        }
     
    }
    public User LostToken(Long id) {
        User existingUser = userRepository.findById(id).orElse(null);

        if (existingUser != null) {
        		existingUser.setToken(null);
                return userRepository.save(existingUser);
            } 
        else {
            return null;
        }
     
    }
}
