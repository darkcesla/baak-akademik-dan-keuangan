package com.springboot.restfullwebservice.repository;


import com.springboot.restfullwebservice.Enitity.SuratIzinBermalam;
import java.util.List;

import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;

@Repository
public interface SuratIzinBermalamRepository extends JpaRepository<SuratIzinBermalam, Long> {
    List<SuratIzinBermalam> findByUserId(Long userId);
}