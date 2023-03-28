package com.stage.biblioteca.repository.libri;

import com.stage.biblioteca.entity.libri.Libri;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.data.repository.PagingAndSortingRepository;

import java.util.List;

public interface LibriRepo extends PagingAndSortingRepository<Libri, Integer>, JpaRepository<Libri, Integer> {
}