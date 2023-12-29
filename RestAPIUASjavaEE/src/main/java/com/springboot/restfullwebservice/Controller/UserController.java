package com.springboot.restfullwebservice.Controller;

import java.time.LocalDateTime;
import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;
import java.util.Map;
import java.util.stream.Collectors;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.security.core.Authentication;
import org.springframework.security.core.context.SecurityContextHolder;
import org.springframework.web.bind.annotation.DeleteMapping;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.PutMapping;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RequestHeader;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;
import io.jsonwebtoken.Claims;

import com.springboot.restfullwebservice.JwtUtil;
import com.springboot.restfullwebservice.Enitity.LoginResponse;
import com.springboot.restfullwebservice.Enitity.Ruangan;
import com.springboot.restfullwebservice.Enitity.User;
import com.springboot.restfullwebservice.service.UserService;

import org.springframework.http.HttpHeaders;
import org.springframework.web.context.request.RequestContextHolder;
import org.springframework.web.context.request.ServletRequestAttributes;


@RestController
@RequestMapping("/api/users")
public class UserController {

    @Autowired
    private UserService userService;

    @Autowired
    private JwtUtil jwtUtil;

    @PostMapping("/register")
    public ResponseEntity<?> register(@RequestBody User user) {
        List<User> allUsers = userService.getAllUsers();
        boolean usernameExists = allUsers.stream().anyMatch(u -> u.getUsername().equals(user.getUsername()));

        if (usernameExists) {
            Map<String, String> error = new HashMap<>();
            error.put("message", "Username sudah digunakan");
            return ResponseEntity.status(HttpStatus.UNAUTHORIZED).body(error);
        } else {
            User registeredUser = userService.registerUser(user);
            return new ResponseEntity<>(registeredUser, HttpStatus.CREATED);
        }
    }


    @PostMapping("/login")
    public ResponseEntity<?> login(@RequestBody User loginRequest) {
        User user = userService.loginUser(loginRequest.getUsername(), loginRequest.getPassword());
        if (user != null) {
            String jwtToken = jwtUtil.generateToken(user);

            user.setToken(jwtToken);

            LoginResponse response = new LoginResponse(user);

            return ResponseEntity.ok(response);
        } else {
        	  Map<String, String> error = new HashMap<>();
              error.put("error", "Username atau password salah");
              return ResponseEntity.status(HttpStatus.UNAUTHORIZED).body(error);        }
    }
    @GetMapping("/mahasiswa/all")
    public List<User> getAllMahasiswa(@RequestHeader("Authorization") String token) {
        User loggedInUser;
        String jwtToken = token.substring(7); // Mengambil token setelah "Bearer "
        Claims claims = jwtUtil.extractAllClaims(jwtToken);
        String username = claims.getSubject();
        loggedInUser = userService.findUserByUsername(username);
        loggedInUser.setToken(jwtToken);
        
        if (loggedInUser.getRoles().toString().equals("Admin")) {
            List<User> allUsers = userService.getAllUsers();
            List<User> mahasiswaList = allUsers.stream()
                    .filter(userFromList -> userFromList.getRoles().equals("Mahasiswa"))
                    .collect(Collectors.toList());
            return mahasiswaList;
        } else {
            return new ArrayList<>(); 
        }
    }

    
    @PutMapping("mahasiswa/edit/{id}")
    public ResponseEntity<User> updateUser(@RequestHeader("Authorization") String token,@PathVariable Long id, @RequestBody User updatedUser) {
    	  User loggedInUser;
          String jwtToken = token.substring(7); // Mengambil token setelah "Bearer "
          Claims claims = jwtUtil.extractAllClaims(jwtToken);
          String username = claims.getSubject();
          loggedInUser = userService.findUserByUsername(username);
          loggedInUser.setToken(jwtToken);
          
          if (loggedInUser.getRoles().toString().equals("Admin")) {
        	  User updated = userService.updateUser(id, updatedUser);
        if (updated != null) {
            return ResponseEntity.ok(updated);
        } 
          }
            return ResponseEntity.notFound().build();
        }
    @DeleteMapping("mahasiswa/delete/{id}")
    public ResponseEntity<?> deleteUser(@RequestHeader("Authorization") String token,@PathVariable Long id) {
    	  User loggedInUser;
          String jwtToken = token.substring(7); // Mengambil token setelah "Bearer "
          Claims claims = jwtUtil.extractAllClaims(jwtToken);
          String username = claims.getSubject();
          loggedInUser = userService.findUserByUsername(username);
          loggedInUser.setToken(jwtToken);
          
          if (loggedInUser.getRoles().toString().equals("Admin")) {
        	userService.deleteUserById(id);
        	 Map<String, String> success = new HashMap<>();
        	 success.put("success", "Berhasil Menghapus Kaos");
             return ResponseEntity.status(HttpStatus.OK).body(success);  
             } 
          
           return ResponseEntity.notFound().build();
        }
    
    @GetMapping("mahasiswa/get/{id}")
    public ResponseEntity<User> getUserById(@PathVariable Long id,@RequestHeader("Authorization") String token) {
        User user = userService.getUserById(id);
        User loggedInUser;
        String jwtToken = token.substring(7); // Mengambil token setelah "Bearer "
        Claims claims = jwtUtil.extractAllClaims(jwtToken);
        String username = claims.getSubject();
        loggedInUser = userService.findUserByUsername(username);
        loggedInUser.setToken(jwtToken);
        
        if (loggedInUser.getRoles().toString().equals("Admin")) {
        	if (user != null) {
        		return new ResponseEntity<>(user, HttpStatus.OK);
        	} 
        }
            return new ResponseEntity<>(HttpStatus.NOT_FOUND);
        
    }
    
    
    @GetMapping("/restricted")
    public ResponseEntity<String> getRestrictedData() {
        ServletRequestAttributes attr = (ServletRequestAttributes) RequestContextHolder.currentRequestAttributes();
        String jwtToken = attr.getRequest().getHeader(HttpHeaders.AUTHORIZATION);
        String username = jwtUtil.extractUsername(jwtToken);


        if (jwtToken == null || jwtToken.isEmpty()) {
            return new ResponseEntity<>("Unauthorized", HttpStatus.UNAUTHORIZED);
        }

        return new ResponseEntity<>("Restricted Data - You have access " + username + "", HttpStatus.OK);
    }
    
    @GetMapping("/validate-token")
    public ResponseEntity<LoginResponse> validateToken(@RequestHeader("Authorization") String token) {
    	User user;
        if (token == null || !token.startsWith("Bearer ")) {
            return ResponseEntity.status(HttpStatus.NOT_FOUND).body(null);
        }

        String jwtToken = token.substring(7); // Mengambil token setelah "Bearer "

        try {
            Claims claims = jwtUtil.extractAllClaims(jwtToken);
            String username = claims.getSubject();
            user = userService.findUserByUsername(username);
            user.setToken(jwtToken);
            LoginResponse response = new LoginResponse(user);


            return ResponseEntity.ok(response);
        } catch (Exception e) {
            return ResponseEntity.status(HttpStatus.NOT_FOUND).body(null);
        }
    }
    
    @GetMapping("/logout")
    public ResponseEntity<?> Logout(
            @RequestHeader("Authorization") String token
            ) {
      
        User loggedInUser;
        String jwtToken = token.substring(7); // Mengambil token setelah "Bearer "
        Claims claims = jwtUtil.extractAllClaims(jwtToken);
        String username = claims.getSubject();
        loggedInUser = userService.findUserByUsername(username);
        loggedInUser.setToken(jwtToken);
                User loggedOutUser = userService.LostToken(loggedInUser.getId());
                if (loggedOutUser != null) {
                    Map<String, String> successMap = new HashMap<>();
                    successMap.put("success", "Berhasil logout");
                    return ResponseEntity.status(HttpStatus.OK).body(successMap);
                } else {
                    return ResponseEntity.status(HttpStatus.INTERNAL_SERVER_ERROR).build();
                }
            }
}     



