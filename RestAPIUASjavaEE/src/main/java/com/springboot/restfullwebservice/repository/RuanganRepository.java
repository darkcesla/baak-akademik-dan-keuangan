package com.springboot.restfullwebservice.repository;


import com.springboot.restfullwebservice.Enitity.Ruangan;

import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;

@Repository
public interface RuanganRepository extends JpaRepository<Ruangan, Long> {

}