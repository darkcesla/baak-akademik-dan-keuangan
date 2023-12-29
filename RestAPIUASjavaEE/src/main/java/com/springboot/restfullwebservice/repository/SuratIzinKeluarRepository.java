package com.springboot.restfullwebservice.repository;


import com.springboot.restfullwebservice.Enitity.SuratIzinKeluar;
import java.util.List;

import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;

@Repository
public interface SuratIzinKeluarRepository extends JpaRepository<SuratIzinKeluar, Long> {
    List<SuratIzinKeluar> findByUserId(Long userId);

}