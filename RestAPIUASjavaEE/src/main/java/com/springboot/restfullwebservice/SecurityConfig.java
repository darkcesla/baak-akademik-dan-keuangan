package com.springboot.restfullwebservice;
import org.springframework.context.annotation.Bean;
import org.springframework.context.annotation.Configuration;
import org.springframework.http.HttpMethod;
import org.springframework.security.config.annotation.authentication.builders.AuthenticationManagerBuilder;
import org.springframework.security.config.annotation.method.configuration.EnableGlobalMethodSecurity;
import org.springframework.security.config.annotation.web.builders.HttpSecurity;
import org.springframework.security.config.annotation.web.configuration.EnableWebSecurity;
import org.springframework.security.config.annotation.web.configuration.WebSecurityConfigurerAdapter;
import org.springframework.security.core.userdetails.UserDetailsService;
import org.springframework.security.crypto.bcrypt.BCryptPasswordEncoder;
import org.springframework.security.crypto.password.PasswordEncoder;

@Configuration
@EnableWebSecurity
@EnableGlobalMethodSecurity(prePostEnabled = true)
public class SecurityConfig extends WebSecurityConfigurerAdapter {

	
    @Override
    protected void configure(HttpSecurity http) throws Exception {
        http.csrf().disable()
            .authorizeRequests()
                .antMatchers("/api/users/**").permitAll() // Allow registration without authentication
                .antMatchers("/api/users/login").permitAll() // Allow login without authentication
                .antMatchers("/api/users/restricted").permitAll() // Allow login without authentication
                .antMatchers("/api/users/validate-token").permitAll() 
                .antMatchers("/api/booking/**").permitAll() 
                .antMatchers("/api/ruangan/**").permitAll() // Allow login without authentication
                .antMatchers("/api/surat/**").permitAll()
                .antMatchers("/api/izinkeluar/**").permitAll()
                .antMatchers("/api/izinbermalam/**").permitAll()
                .antMatchers("/api/kaos/**").permitAll()
                .antMatchers("/api/paymentkaos/**").permitAll() // Allow registration without authentication
                .anyRequest().authenticated()
            .and()
                .formLogin()
                .loginPage("/login")
                .permitAll()
            .and()
                .logout()
                .permitAll();
    }

    @Bean
    public BCryptPasswordEncoder passwordEncoder() {
        return new BCryptPasswordEncoder();
    }
}
